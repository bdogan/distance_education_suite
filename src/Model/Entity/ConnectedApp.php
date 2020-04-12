<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ConnectedApp Entity
 *
 * @property int $id
 * @property string $alias
 * @property string $access_token
 * @property string $token_type
 * @property string|null $user
 * @property string|null $refresh_token
 * @property string|null $scope
 * @property-read array $user_formatted
 * @property-read array $scope_formatted
 * @property \Cake\I18n\FrozenTime|null $expires_in
 */
class ConnectedApp extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'alias' => true,
        'access_token' => true,
        'token_type' => true,
        'user' => true,
        'refresh_token' => true,
        'scope' => true,
        'expires_in' => true,
    ];

    /**
     * @return mixed
     */
    public function _getUserFormatted()
    {
        return json_decode($this->user, true);
    }

    /**
     * @return mixed
     */
    public function _getScopeFormatted()
    {
        return json_decode($this->scope, true);
    }

}
