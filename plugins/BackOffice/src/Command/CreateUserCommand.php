<?php
declare(strict_types=1);

namespace BackOffice\Command;

use App\Model\Entity\User;
use Cake\Console\Arguments;
use Cake\Command\Command;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;

/**
 * CreateUser command.
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class CreateUserCommand extends Command
{

    public function initialize(): void
    {
        parent::initialize();
        $this->loadModel('Users');
    }

    /**
     * Hook method for defining this command's option parser.
     *
     * @see https://book.cakephp.org/3.0/en/console-and-shells/commands.html#defining-arguments-and-options
     *
     * @param \Cake\Console\ConsoleOptionParser $parser The parser to be defined
     * @return \Cake\Console\ConsoleOptionParser The built parser.
     */
    public function buildOptionParser(ConsoleOptionParser $parser): ConsoleOptionParser
    {
        $parser = parent::buildOptionParser($parser);

        $parser->addOption('name', [
            'short' => 'n',
            'help' => 'Adınız nedir',
            'default' => 'Sistem Yöneticisi'
        ]);

        $parser->addArgument('email', [
            'help' => 'Mail adresiniz',
            'required' => true
        ]);

        $parser->addArgument('password', [
            'help' => 'Şifreniz',
            'required' => false
        ]);

        return $parser;
    }

    /**
     * Implement this method with your command's logic.
     *
     * @param \Cake\Console\Arguments $args The command arguments.
     * @param \Cake\Console\ConsoleIo $io The console io
     * @return null|void|int The exit code or null for success
     */
    public function execute(Arguments $args, ConsoleIo $io)
    {
        $user = new User();
        $user->name = $args->getOption('name');
        $user->email = $args->getArgument('email');
        $user->password = $args->getArgument('password');

        if (!$this->Users->save($user)) {
            $io->error('Kullanıcı oluşturulamadı');
            return 1;
        }

        $io->success(sprintf('%s <%s> kullanıcı başarıyla oluşturuldu', $user->name, $user->email));
        return 0;
    }
}
