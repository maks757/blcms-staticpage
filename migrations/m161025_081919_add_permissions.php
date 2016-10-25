<?php

use yii\db\Migration;

class m161025_081919_add_permissions extends Migration
{
    public function up()
    {
        $auth = Yii::$app->authManager;

        /*Add permissions*/
        $viewStaticPages = $auth->createPermission('viewStaticPages');
        $viewStaticPages->description = 'View list of static pages';
        $auth->add($viewStaticPages);

        $editStaticPage = $auth->createPermission('editStaticPage');
        $editStaticPage->description = 'Edit static page';
        $auth->add($editStaticPage);

        $deleteStaticPage = $auth->createPermission('deleteStaticPage');
        $deleteStaticPage->description = 'Delete static page';
        $auth->add($deleteStaticPage);


        /*Add roles*/
        $staticPageManager = $auth->createRole('staticPageManager');
        $staticPageManager->description = 'Static page manager';
        $auth->add($staticPageManager);


        /*Add childs*/
        $auth->addChild($staticPageManager, $viewStaticPages);
        $auth->addChild($staticPageManager, $editStaticPage);
        $auth->addChild($staticPageManager, $deleteStaticPage);

    }

    public function down()
    {
        $auth = Yii::$app->authManager;

        $viewStaticPages = $auth->getPermission('viewStaticPages');
        $editStaticPage = $auth->getPermission('editStaticPage');
        $deleteStaticPage = $auth->getPermission('deleteStaticPage');

        $staticPageManager = $auth->getRole('staticPageManager');

        $auth->removeChildren($staticPageManager);

        $auth->remove($deleteStaticPage);
        $auth->remove($editStaticPage);
        $auth->remove($viewStaticPages);
        $auth->remove($staticPageManager);
    }

}
