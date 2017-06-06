# seo static page
Static pages seo-data extension

```text
php yii migrate --migrationPath=@vendor/maks757/seo_static_page/migrations
```

## Usage

Add behavior to controller with unique key. This key you will use in admin panel of module for setting this page:

```php
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
 
```php
$this->registerStaticSeoData();
```