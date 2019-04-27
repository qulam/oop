<?php

namespace app\config;

use app\core\Helpers;

class Params
{

	public static $id;
    public static $defaultLang;
    public static $languages;

	public function __construct()
	{
		self::$id = Helpers::getId();
		self::$defaultLang = 'az';
		self::$languages = ['az', 'en', 'ru'];
	}

	public static function ParamsConfig()
	{	
		$id = self::$id;
		return [
			'rules' => [
				
				'' => 'site/index',
				'site' => 'site/index',
				'site/login' => 'site/login',
				'site/logout' => 'site/logout',
   				'products' => 'products/index',
   				'products/update/'.$id => 'products/update/'.$id,
   		   		'products/update/'.$id => 'products/update/'.$id,
   		   		'products/delete/'.$id => 'products/delete/'.$id,
   		   		'blogs' => 'blogs/index',
   		   		'blogs/create' => 'blogs/create',
   		   		'blogs/update/'.$id => 'blogs/update/'.$id,
   		   		'blogs/delete/'.$id => 'blogs/delete/'.$id,
                'news' => 'news/index',
                'news/index' => 'news/index',
                'news/create' => 'news/create',
                'news/update/'.$id => 'news/update/'.$id,
                'news/delete/'.$id => 'news/delete/'.$id,
   		   		'user' => 'user/index',
   		   		'user/view/'.$id => 'user/view/'.$id,
   		   		'user/delete/'.$id => 'user/delete/'.$id,

			],
		];
	}

	public static function Modules()
	{
		return [
			[
				'label' => 'Home',
				'url' => 'site/index',
				'badge' => false,
				'children' => false,
			],
			[
				'label' => 'Blogs',
				'url' => 'blogs/index',
				'badge' => false,
				'children' => [
					[
						'label' => 'create',
						'url' => 'blogs/create',
					],
					[
						'label' => 'category',
						'url' => 'blogs-category/index',
					]
				],
			],
			[
				'label' => 'Products',
				'url' => 'products/index',
				'badge' => false,
				'children' => [
					[
						'label' => 'create',
						'url' => 'products/create',
					],
					[
						'label' => 'category',
						'url' => 'products-category/index',
					]
				],
			],
			[
				'label' => 'News',
				'url' => 'news/index',
				'badge' => false,
				'children' => [
					[
						'label' => 'create',
						'url' => 'news/create',
					],
					[
						'label' => 'category',
						'url' => 'news-category/index',
					]
				],
			],
            [
                'label' => 'Projects',
                'url' => 'projects/index',
                'badge' => false,
                'children' => [
                    [
                        'label' => 'create',
                        'url' => 'projects/create',
                    ],
                    [
                        'label' => 'category',
                        'url' => 'projects-category/index',
                    ]
                ],
            ],
			[
				'label' => 'Users',
				'url' => 'user/index',
				'badge' => false,
				'children' => [
					[
						'label' => 'create',
						'url' => 'user/create',
					],
				],
			],
			// Some Modules ..

		];

	}

}
