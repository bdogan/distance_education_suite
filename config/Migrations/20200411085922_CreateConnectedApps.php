<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateConnectedApps extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $connectedApps = $this->table('connected_apps');
        $connectedApps
            ->addColumn('alias', 'string', [ 'limit' => 45 ])
            ->addColumn('access_token', 'string', [ 'limit' => 255 ])
            ->addColumn('token_type', 'string', [ 'limit' => 45 ])
            ->addColumn('user', 'text', [ 'null' => true, 'default' => null ])
            ->addColumn('refresh_token', 'string', [ 'limit' => 255, 'null' => true, 'default' => null ])
            ->addColumn('scope', 'string', [ 'limit' => 255, 'null' => true, 'default' => null])
            ->addColumn('expires_in', 'timestamp', [ 'null' => true, 'default' => null ])
            ->addIndex([ 'alias' ], [ 'unique' => true ])
            ->create();
    }
}
