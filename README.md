# blcms-staticpage
Static pages seo-data extention for BlackLamp CMS

php yii migrate --migrationPath=@yii/rbac/migrations
php yii migrate --migrationPath=@vendor/black-lamp/blcms-staticpage/migrations

**Roles and its permissions:**

_staticPageManager_
- viewStaticPages
- editStaticPage
- deleteStaticPage

**Usage**

Add behavior to controller with unique key. This key you will use in admin panel of module for setting this page:

```
public function behaviors()
    {
        return [
            'staticPage' => [
                'class' => StaticPageBehavior::className(),
                'key' => 'shop'
            ]
        ];
    }
```

Then add in action next record. It adds to your page title, meta-description and meta-keywords:
 
```
$this->registerStaticSeoData();
```