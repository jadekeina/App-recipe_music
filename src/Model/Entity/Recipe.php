<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Recipe Entity
 *
 * @property int $id
 * @property string $title
 * @property string $ingredients
 * @property string $steps
 * @property int $duration
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $user_id
 * @property string|null $spotify_playlist_id
 * @property string $image
 * @property bool $is_published
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\FavoriteUser[] $favorite_users
 */
class Recipe extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'title' => true,
        'ingredients' => true,
        'steps' => true,
        'duration' => true,
        'created' => true,
        'modified' => true,
        'user_id' => true,
        'spotify_playlist_id' => true,
        'image' => true,
        'is_published' => true,
        'user' => true,
        'favorite_users' => true,
    ];
}
