<?php
namespace DataFixtures\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Console\Request as ConsoleRequest;
use RuntimeException;
use Provider\Entity\User;
use Provider\Entity\UserRole;

class DataFixturesController extends AbstractActionController
{
    public function runAction()
    {
        $service = $this->getServiceLocator();
        $model = $service->get('DataFixture\Model\DataFixture');

        $request = $this->getRequest();
        if (!$request instanceof ConsoleRequest) {
            throw new RuntimeException('You can only use this action from a console!');
        }

        $model->addEntity('User');
        $model->addEntity('UserRole');

        //drop tables
        if(!$model->dropTables()) {
            throw new RuntimeException('Error');
        }
        echo "Remove tables - success \n";
        //update tables
        if(!$model->updateTables()) {
            throw new RuntimeException('Error');
        }
        echo "Create tables - success \n";
        //add content
        $userRole1 = new UserRole();
        $userRole1->role = 'admin';
        $model->addContent($userRole1);

        $userRole2 = new UserRole();
        $userRole2->role = 'market_manager';
        $model->addContent($userRole2);

        $user = new User();
        $user->first_name = 'Razvan';
        $user->last_name = 'Moldovan';
        $user->userRole = $userRole1;
        $user->password = sha1('12345678');
        $user->email = 'razvan.moldovan@arobs.com';
        $user->phone = '0748059223';
        $user->last_activity = new \DateTime();
        $user->lock = 0;
        $model->addContent($user);

        echo "Insert content- success \n";

        return "Data fixtures runs successfully!\n";
    }
}
