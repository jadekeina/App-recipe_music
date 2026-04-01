<?php
namespace App\Service;

use Cake\Core\Configure;

class SpotifyService
{
    private string $clientId;
    private string $clientSecret;
    private string $accessToken; // Correction faute de frappe : accesToken -> accessToken

    public function __construct()
    {
        // Récupération des clés dans config/app_local.php ou app.php
        $this->clientId = Configure::read('Spotify.client_id');
        $this->clientSecret = Configure::read('Spotify.client_secret');

        // On génère le token dès l'instanciation du service
        $this->accessToken = $this->getAccessToken();
    }

    /**
     * Authentification "Client Credentials" (Mode Application)
     * Permet de lire n'importe quelle playlist publique.
     */
    private function getAccessToken(): string
    {
        $url = 'https://accounts.spotify.com/api/token';
        $credentials = base64_encode($this->clientId . ':' . $this->clientSecret);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Basic ' . $credentials,
            'Content-Type: application/x-www-form-urlencoded',
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        // Désactiver SSL en local si nécessaire, mais attention en production
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        $data = json_decode($response, true);
        curl_close($ch);

        return $data['access_token'] ?? '';
    }

    /**
     * Récupère les détails d'une playlist
     */
    public function getPlaylist(string $playlistId): ?array
    {
        $url = 'https://api.spotify.com/v1/playlists/' . $playlistId;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->accessToken,
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);

        // Si Spotify renvoie une erreur (ex: playlist privée ou ID inexistant)
        if (isset($data['error']) || empty($data)) {
            return null;
        }

        // Simplification : L'objet Playlist contient déjà les morceaux dans ['tracks']['items']
        // On traite les 10 premiers directement ici
        $rawTracks = $data['tracks']['items'] ?? [];
        $tracks = [];

        foreach (array_slice($rawTracks, 0, 10) as $item) {
            if (isset($item['track'])) {
                $tracks[] = [
                    'name' => $item['track']['name'] ?? 'Inconnu',
                    'artist' => $item['track']['artists'][0]['name'] ?? 'Inconnu',
                    // Conversion ms en mm:ss
                    'duration' => gmdate('i:s', floor($item['track']['duration_ms'] / 1000)),
                ];
            }
        }

        return [
            'name' => $data['name'] ?? 'Playlist sans nom',
            'description' => $data['description'] ?? '',
            // ATTENTION : Spotify utilise "images" au pluriel
            'image' => $data['images'][0]['url'] ?? null,
            'url' => $data['external_urls']['spotify'] ?? '#',
            'tracks' => $tracks,
        ];
    }

    /**
     * Extrait l'ID depuis une URL propre ou avec paramètres de tracking
     */
    public function extractPlaylistId(string $url): ?string
    {
        // On cherche la partie après /playlist/
        if (preg_match('/playlist\/([a-zA-Z0-9]+)/', $url, $matches)) {
            return $matches[1];
        }

        return $url;
    }
}