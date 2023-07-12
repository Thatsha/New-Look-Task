<?php

namespace App\Providers;




use App\Interfaces\ImageInterface;
use App\Interfaces\Product\ProductInterface;
use App\Interfaces\Setting\CategoryInterface;
use App\Interfaces\Setting\NameSettingInterface;
use App\Interfaces\Shop\BranchInterface;
use App\Interfaces\Shop\PromoInterface;
use App\Interfaces\Shop\DeliveryZoneInterface;
use App\Interfaces\Shop\ShopInterface;
use App\Interfaces\User\UserInterface;

use App\Repositories\ImageRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Setting\CategoryRepository;
use App\Repositories\Setting\NameSettingRepository;
use App\Repositories\Shop\BranchRepository;
use App\Repositories\Shop\PromoRepository;
use App\Repositories\Shop\DeliveryZoneRepository;
use App\Repositories\Shop\ShopRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {


        $this->app->bind(UserInterface::Class, UserRepository::Class);
        $this->app->bind(NameSettingInterface::Class, NameSettingRepository::Class);
        $this->app->bind(ImageInterface::Class, ImageRepository::Class);

        $this->app->bind(CategoryInterface::Class, CategoryRepository::Class);

        $this->app->bind(ProductInterface::Class, ProductRepository::Class);

        $this->app->bind(ShopInterface::Class, ShopRepository::Class);
        $this->app->bind(BranchInterface::Class, BranchRepository::Class);
        $this->app->bind(PromoInterface::Class, PromoRepository::Class);
        $this->app->bind(DeliveryZoneInterface::Class, DeliveryZoneRepository::Class);


    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
