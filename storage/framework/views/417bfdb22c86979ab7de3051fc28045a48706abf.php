<?php
    if (empty($authUser) and auth()->check()) {
        $authUser = auth()->user();
    }

    $navBtnUrl = null;
    $navBtnText = null;

    if (request()->is('forums*')) {
        $navBtnUrl = '/forums/create-topic';
        $navBtnText = trans('update.create_new_topic');
    } else {
        $navbarButton = getNavbarButton(!empty($authUser) ? $authUser->role_id : null, empty($authUser));

        if (!empty($navbarButton)) {
            $navBtnUrl = $navbarButton->url;
            $navBtnText = $navbarButton->title;
        }
    }
?>

<div id="navbarVacuum"></div>



<?php if(!Auth::user()): ?>
    <!-----before login----->
    <nav id="navbar" class="navbar navbar-expand-lg navbar-light">
        <div class="<?php echo e((!empty($isPanel) and $isPanel) ? 'container-fluid' : 'container'); ?>">
            <div class="d-flex align-items-center justify-content-between w-100">
                <a class="navbar-brand navbar-order d-flex align-items-center justify-content-center mr-0 <?php echo e((empty($navBtnUrl) and empty($navBtnText)) ? 'ml-auto' : ''); ?>"
                    href="/">
                    <?php if(!empty($generalSettings['logo'])): ?>
                        <img src="<?php echo e($generalSettings['logo']); ?>" class="img-cover" alt="site logo">
                    <?php endif; ?>
                </a>
                <button class="navbar-toggler navbar-order" type="button" id="navbarToggle">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="mx-lg-30 d-none d-lg-flex flex-grow-1 navbar-toggle-content " id="navbarContent">
                    <div class="navbar-toggle-header text-right d-lg-none">
                        <button class="btn-transparent" id="navbarClose">
                            <i data-feather="x" width="32" height="32"></i>
                        </button>
                    </div>
                    <ul class="navbar-nav mr-auto d-flex align-items-center">
                        <?php if(!empty($categories) and count($categories)): ?>
                            <li class="mr-lg-25">
                                <div class="menu-category">
                                    <ul>
                                        <li class="cursor-pointer user-select-none d-flex xs-categories-toggle">
                                            <i data-feather="grid" width="20" height="20"
                                                class="mr-10 d-none d-lg-block"></i>
                                            <?php echo e(trans('categories.categories')); ?>

                                            <ul class="cat-dropdown-menu">
                                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li>
                                                        <a href="<?php echo e($category->getUrl()); ?>"
                                                            class="<?php echo e((!empty($category->subCategories) and count($category->subCategories)) ? 'js-has-subcategory' : ''); ?>">
                                                            <div class="d-flex align-items-center">
                                                                <?php if(!empty($category->icon)): ?>
                                                                    <img src="<?php echo e($category->icon); ?>"
                                                                        class="cat-dropdown-menu-icon mr-10"
                                                                        alt="<?php echo e($category->title); ?> icon">
                                                                <?php endif; ?>
                                                                <?php echo e($category->title); ?>

                                                            </div>
                                                            <?php if(!empty($category->subCategories) and count($category->subCategories)): ?>
                                                                <i data-feather="chevron-right" width="20"
                                                                    height="20"
                                                                    class="d-none d-lg-inline-block ml-10"></i>
                                                                <i data-feather="chevron-down" width="20"
                                                                    height="20" class="d-inline-block d-lg-none"></i>
                                                            <?php endif; ?>
                                                        </a>
                                                        <?php if(!empty($category->subCategories) and count($category->subCategories)): ?>
                                                            <ul class="sub-menu" data-simplebar
                                                                <?php if(!empty($isRtl) and $isRtl): ?> data-simplebar-direction="rtl" <?php endif; ?>>
                                                                <?php $__currentLoopData = $category->subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <li>
                                                                        <a href="<?php echo e($subCategory->getUrl()); ?>">
                                                                            <?php if(!empty($subCategory->icon)): ?>
                                                                                <img src="<?php echo e($subCategory->icon); ?>"
                                                                                    class="cat-dropdown-menu-icon mr-10"
                                                                                    alt="<?php echo e($subCategory->title); ?> icon">
                                                                            <?php endif; ?>
                                                                            <?php echo e($subCategory->title); ?>

                                                                        </a>
                                                                    </li>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </ul>
                                                        <?php endif; ?>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        <?php endif; ?>
                        <li>
                            
                            <form action="/search" method="get" class="d-inline-flex mt-5 p-5 w-100">
                                <div class="bar">
                                    <input type="text" name="search" class="searchbar" title="Search"
                                        placeholder="Search courses, instructors and organizations">
                                    <button type="submit" class="search-button">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </li>
                        


                        <li class="nav-item mr-15">
                            <a class="nav-link" href="<?php echo e(route('instructor-finder.index')); ?>">Tutorhub</a>
                        </li>
                        <li class="nav-item mr-15">
                            <a class="nav-link" href="<?php echo e(route('products.store')); ?>">Stores</a>
                        </li>
                        <li class="nav-item mr-15">
                            <a class="nav-link" href="<?php echo e(route('forums.index')); ?>">Community</a>
                        </li>



                    </ul>
                    <div class="d-flex">
                        <?php echo $__env->make(getTemplate() . '.includes.shopping-cart-dropdwon', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <div class="border-left mx-5 mx-lg-15 mt-15"></div>
                        <!--<?php echo $__env->make(getTemplate() . '.includes.notification-dropdown', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>-->
                    </div>
                    
                </div>
                <div class="nav-icons-or-start-live navbar-order d-flex align-items-center justify-content-end">
                    <?php if(!empty($navBtnUrl)): ?>
                        <a href="<?php echo e($navBtnUrl); ?>"
                            class="d-none d-lg-flex btn btn-sm btn-primary nav-start-a-live-btn">
                            Login
                        </a>
                        <a href="<?php echo e($navBtnUrl); ?>"
                            class="d-flex d-lg-none text-primary nav-start-a-live-btn font-14">
                            Login
                        </a>
                    <?php endif; ?>
                    <?php if(!empty($isPanel)): ?>
                        <?php if($authUser->checkAccessToAIContentFeature()): ?>
                            <div class="js-show-ai-content-drawer show-ai-content-drawer-btn d-flex-center mr-40">
                                <div class="d-flex-center size-32 rounded-circle bg-white">
                                    <img src="/assets/default/img/ai/ai-chip.svg" alt="ai" class=""
                                        width="16px" height="16px">
                                </div>
                                <span
                                    class="ml-5 font-weight-500 text-secondary font-14 d-none d-lg-block"><?php echo e(trans('update.ai_content')); ?></span>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <div class="d-none nav-notify-cart-dropdown top-navbar">
                        <?php echo $__env->make('web.default.includes.shopping-cart-dropdwon', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <div class="border-left mx-15"></div>
                        <?php echo $__env->make('web.default.includes.notification-dropdown', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-----before login----->
<?php endif; ?>


<?php if(Auth::user()): ?>
    <!-----after login----->
    <nav id="navbar" class="navbar navbar-expand-lg navbar-light">
        <div class="<?php echo e((!empty($isPanel) and $isPanel) ? 'container-fluid' : 'container'); ?>">
            <div class="d-flex align-items-center justify-content-between w-100">
                <a class="navbar-brand navbar-order d-flex align-items-center justify-content-center mr-0 <?php echo e((empty($navBtnUrl) and empty($navBtnText)) ? 'ml-auto' : ''); ?>" href="/">
                    <?php if(!empty($generalSettings['logo'])): ?>
                        <img src="<?php echo e($generalSettings['logo']); ?>" class="img-cover" alt="site logo">
                    <?php endif; ?>
                </a>
                <button class="navbar-toggler navbar-order" type="button" id="navbarToggle">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="mx-lg-30 d-none d-lg-flex flex-grow-1 navbar-toggle-content " id="navbarContent">
                    <div class="navbar-toggle-header text-right d-lg-none">
                        <button class="btn-transparent" id="navbarClose">
                            <i data-feather="x" width="32" height="32"></i>
                        </button>
                    </div>
                    <ul class="navbar-nav mr-auto d-flex align-items-center">
                        <?php if(!empty($categories) and count($categories)): ?>
                            <li class="mr-lg-25">
                                <div class="menu-category">
                                    <ul>
                                        <li class="cursor-pointer user-select-none d-flex xs-categories-toggle">
                                            <i data-feather="grid" width="20" height="20"
                                                class="mr-5 d-none d-lg-block"></i>
                                            <?php echo e(trans('categories.categories')); ?>

                                            <ul class="cat-dropdown-menu">
                                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li>
                                                        <a href="<?php echo e($category->getUrl()); ?>"
                                                            class="<?php echo e((!empty($category->subCategories) and count($category->subCategories)) ? 'js-has-subcategory' : ''); ?>">
                                                            <div class="d-flex align-items-center">
                                                                <?php if(!empty($category->icon)): ?>
                                                                    <img src="<?php echo e($category->icon); ?>"
                                                                        class="cat-dropdown-menu-icon mr-10"
                                                                        alt="<?php echo e($category->title); ?> icon">
                                                                <?php endif; ?>
                                                                <?php echo e($category->title); ?>

                                                            </div>
                                                            <?php if(!empty($category->subCategories) and count($category->subCategories)): ?>
                                                                <i data-feather="chevron-right" width="20"
                                                                    height="20"
                                                                    class="d-none d-lg-inline-block ml-10"></i>
                                                                <i data-feather="chevron-down" width="20"
                                                                    height="20"
                                                                    class="d-inline-block d-lg-none"></i>
                                                            <?php endif; ?>
                                                        </a>
                                                        <?php if(!empty($category->subCategories) and count($category->subCategories)): ?>
                                                            <ul class="sub-menu" data-simplebar
                                                                <?php if(!empty($isRtl) and $isRtl): ?> data-simplebar-direction="rtl" <?php endif; ?>>
                                                                <?php $__currentLoopData = $category->subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <li>
                                                                        <a href="<?php echo e($subCategory->getUrl()); ?>">
                                                                            <?php if(!empty($subCategory->icon)): ?>
                                                                                <img src="<?php echo e($subCategory->icon); ?>"
                                                                                    class="cat-dropdown-menu-icon mr-10"
                                                                                    alt="<?php echo e($subCategory->title); ?> icon">
                                                                            <?php endif; ?>
                                                                            <?php echo e($subCategory->title); ?>

                                                                        </a>
                                                                    </li>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </ul>
                                                        <?php endif; ?>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        <?php endif; ?>
                        
                        
                        <li class="nav-item mr-15">
                            <a class="nav-link" href="<?php echo e(route('instructor-finder.index')); ?>">Tutorhub</a>
                        </li>
                        <li class="nav-item mr-15">
                            <a class="nav-link" href="<?php echo e(route('products.store')); ?>">Stores</a>
                        </li>
                        <li class="nav-item mr-15">
                            <a class="nav-link" href="<?php echo e(route('forums.index')); ?>">Community</a>
                        </li>
                        <li>
                            
                            <form action="/search" method="get" class="d-inline-flex mt-5 p-5 w-100">
                                <div class="bar">
                                    <input type="text" name="search" class="searchbar" title="Search"
                                        placeholder="Search courses, instructors and organizations">
                                    <button type="submit" class="search-button">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <?php echo $__env->make(getTemplate() . '.includes.shopping-cart-dropdwon', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <div class="border-left mx-5 mx-lg-20"></div>
                        <?php echo $__env->make(getTemplate() . '.includes.notification-dropdown', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    
                    <div class="container mt-20">
                        <div class="row">
                            <div class="col-md-4 offset-md-4 col-sm-6 offset-sm-3 col-10 offset-1">
                                <div id="localItems" data-selected-country="US"
                                    data-countries="{&quot;IQ&quot;:&quot;Arabic&quot;,&quot;BD&quot;:&quot;Bangla&quot;,&quot;US&quot;:&quot;English&quot;,&quot;ES&quot;:&quot;Spanish&quot;}"
                                    class="flagstrap">
                                    <select id="flagstrap-fdNeh2ZH" name="country" style="display: none;">
                                        <option value="">Change Language</option>
                                        <option value="IQ">Arabic</option>
                                        <option value="BD">Bangla</option>
                                        <option value="US" selected="selected">English</option>
                                        <option value="ES">Spanish</option>
                                    </select>
                                    <button type="button" data-toggle="dropdown" id="flagstrap-drop-down-fdNeh2ZH"
                                        class="btn btn-default btn-sm dropdown-toggle w-100 text-left">
                                        <span class="flagstrap-selected-fdNeh2ZH">
                                            <i class="flagstrap-icon flagstrap-us" style="margin-right: 5px;"></i>English
                                        </span>
                                        <span class="caret float-right"></span>
                                    </button>
                                    <ul id="flagstrap-drop-down-fdNeh2ZH-list" aria-labelledby="flagstrap-drop-down-fdNeh2ZH"
                                        class="dropdown-menu w-100" style="height: auto; max-height: 350px; overflow-x: hidden;">
                                        <li><a data-val="" class="dropdown-item">Change Language</a></li>
                                        <li><a data-val="IQ" class="dropdown-item"><i class="flagstrap-icon flagstrap-iq"
                                                    style="margin-right: 5px;"></i>Arabic</a></li>
                                        <li><a data-val="BD" class="dropdown-item"><i class="flagstrap-icon flagstrap-bd"
                                                    style="margin-right: 5px;"></i>Bangla</a></li>
                                        <li><a data-val="US" class="dropdown-item"><i class="flagstrap-icon flagstrap-us"
                                                    style="margin-right: 5px;"></i>English</a></li>
                                        <li><a data-val="ES" class="dropdown-item"><i class="flagstrap-icon flagstrap-es"
                                                    style="margin-right: 5px;"></i>Spanish</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <?php if(!empty($isPanel)): ?>
                    <?php if($authUser->checkAccessToAIContentFeature()): ?>
                        <div class="js-show-ai-content-drawer show-ai-content-drawer-btn d-flex-center mr-40">
                            <div class="d-flex-center size-32 rounded-circle bg-white">
                                <img src="/assets/default/img/ai/ai-chip.svg" alt="ai" class=""
                                    width="16px" height="16px">
                            </div>
                            <span
                                class="ml-5 font-weight-500 text-secondary font-14 d-none d-lg-block"><?php echo e(trans('update.ai_content')); ?></span>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                

                <div class="language-select">
                    <div id="localItems" data-selected-country="US"
                        data-countries="{&quot;IQ&quot;:&quot;Arabic&quot;,&quot;BD&quot;:&quot;Bangla&quot;,&quot;US&quot;:&quot;English&quot;,&quot;ES&quot;:&quot;Spanish&quot;}"
                        class="flagstrap">
                        
                        <button type="button" data-toggle="dropdown" id="flagstrap-drop-down-fdNeh2ZH"
                            class="btn btn-default btn-sm dropdown-toggle">
                            <span class="flagstrap-selected-fdNeh2ZH">
                                <img src=assets/admin/img/avatar/avatar-1.png class="rounded"
                                    style="width:30px; height:30px; margin-right:10px;">
                                
                            </span>

                            <span class="caret" style="margin-left: 5px;"></span></button>
                        <ul id="flagstrap-drop-down-fdNeh2ZH-list" aria-labelled-by="flagstrap-drop-down-fdNeh2ZH"
                            class="dropdown-menu dropdown-menu-right"
                            style="height: auto; max-height: 350px; overflow-x: hidden;">
                        

                            <li>
                                <a href="<?php echo e(url('/panel')); ?>" style="align-items: center; display: flex;">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.1" width="20" height="20" viewBox="0 0 256 256"
                                        xml:space="preserve" style="margin-right:10px;">

                                        <defs>
                                        </defs>
                                        <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;"
                                            transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                                            <path
                                                d="M 49.501 20 H 7.378 c -0.552 0 -1 -0.448 -1 -1 s 0.448 -1 1 -1 h 42.123 c 0.553 0 1 0.448 1 1 S 50.054 20 49.501 20 z"
                                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;"
                                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path
                                                d="M 82.622 20 h -3.814 c -0.553 0 -1 -0.448 -1 -1 s 0.447 -1 1 -1 h 3.814 c 0.553 0 1 0.448 1 1 S 83.175 20 82.622 20 z"
                                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;"
                                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path
                                                d="M 73.622 20 h -3.814 c -0.553 0 -1 -0.448 -1 -1 s 0.447 -1 1 -1 h 3.814 c 0.553 0 1 0.448 1 1 S 74.175 20 73.622 20 z"
                                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;"
                                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path
                                                d="M 46.907 79.28 h -3.814 c -0.552 0 -1 -0.447 -1 -1 s 0.448 -1 1 -1 h 3.814 c 0.553 0 1 0.447 1 1 S 47.46 79.28 46.907 79.28 z"
                                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;"
                                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path
                                                d="M 85.427 10.719 H 4.573 C 2.052 10.719 0 12.771 0 15.292 v 59.416 c 0 2.521 2.052 4.572 4.573 4.572 h 31.5 c 0.552 0 1 -0.447 1 -1 s -0.448 -1 -1 -1 h -31.5 C 3.154 77.28 2 76.126 2 74.708 V 26.016 h 86 v 48.692 c 0 1.418 -1.154 2.572 -2.573 2.572 h -31.5 c -0.553 0 -1 0.447 -1 1 s 0.447 1 1 1 h 31.5 c 2.521 0 4.573 -2.051 4.573 -4.572 V 15.292 C 90 12.771 87.948 10.719 85.427 10.719 z M 2 24.016 v -8.723 c 0 -1.419 1.154 -2.573 2.573 -2.573 h 80.854 c 1.419 0 2.573 1.154 2.573 2.573 v 8.723 H 2 z"
                                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;"
                                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path
                                                d="M 22.741 71.875 h -6.482 c -1.462 0 -2.651 -1.189 -2.651 -2.651 v -8.482 c 0 -1.462 1.189 -2.651 2.651 -2.651 h 6.482 c 1.462 0 2.651 1.189 2.651 2.651 v 8.482 C 25.393 70.686 24.203 71.875 22.741 71.875 z M 16.259 60.09 c -0.359 0 -0.651 0.292 -0.651 0.651 v 8.482 c 0 0.359 0.292 0.651 0.651 0.651 h 6.482 c 0.359 0 0.651 -0.292 0.651 -0.651 v -8.482 c 0 -0.359 -0.292 -0.651 -0.651 -0.651 H 16.259 z"
                                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;"
                                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path
                                                d="M 39.741 71.875 h -6.482 c -1.462 0 -2.651 -1.189 -2.651 -2.651 V 56.741 c 0 -1.462 1.189 -2.651 2.651 -2.651 h 6.482 c 1.462 0 2.651 1.189 2.651 2.651 v 12.482 C 42.393 70.686 41.203 71.875 39.741 71.875 z M 33.259 56.09 c -0.359 0 -0.651 0.292 -0.651 0.651 v 12.482 c 0 0.359 0.292 0.651 0.651 0.651 h 6.482 c 0.359 0 0.651 -0.292 0.651 -0.651 V 56.741 c 0 -0.359 -0.292 -0.651 -0.651 -0.651 H 33.259 z"
                                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;"
                                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path
                                                d="M 56.741 71.875 h -6.482 c -1.462 0 -2.651 -1.189 -2.651 -2.651 V 46.741 c 0 -1.462 1.189 -2.651 2.651 -2.651 h 6.482 c 1.462 0 2.651 1.189 2.651 2.651 v 22.482 C 59.393 70.686 58.203 71.875 56.741 71.875 z M 50.259 46.09 c -0.359 0 -0.651 0.292 -0.651 0.651 v 22.482 c 0 0.359 0.292 0.651 0.651 0.651 h 6.482 c 0.359 0 0.651 -0.292 0.651 -0.651 V 46.741 c 0 -0.359 -0.292 -0.651 -0.651 -0.651 H 50.259 z"
                                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;"
                                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path
                                                d="M 73.741 71.875 h -6.482 c -1.462 0 -2.651 -1.189 -2.651 -2.651 V 34.741 c 0 -1.462 1.189 -2.651 2.651 -2.651 h 6.482 c 1.462 0 2.651 1.189 2.651 2.651 v 34.482 C 76.393 70.686 75.203 71.875 73.741 71.875 z M 67.259 34.09 c -0.359 0 -0.651 0.292 -0.651 0.651 v 34.482 c 0 0.359 0.292 0.651 0.651 0.651 h 6.482 c 0.359 0 0.651 -0.292 0.651 -0.651 V 34.741 c 0 -0.359 -0.292 -0.651 -0.651 -0.651 H 67.259 z"
                                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;"
                                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                        </g>
                                    </svg>
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="#" style="align-items: center; display: flex;">
                                    <svg width="25" height="25" fill="#000000" viewBox="0 0 32 32"
                                        version="1.1" xmlns="http://www.w3.org/2000/svg"
                                        style="margin-right: 10px;">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <title>video-camera</title>
                                            <path
                                                d="M30.395 6.362c-0.112-0.071-0.248-0.113-0.395-0.113-0.122 0-0.238 0.030-0.34 0.082l0.004-0.002-6.938 3.468c-0.106-1.426-1.287-2.543-2.729-2.548h-15.996c-1.518 0.002-2.748 1.232-2.75 2.75v12.001c0.002 1.518 1.232 2.748 2.75 2.75h15.996c1.443-0.005 2.623-1.122 2.729-2.538l0.001-0.009 6.939 3.468c0.097 0.050 0.211 0.080 0.333 0.080 0.001 0 0.002 0 0.003 0h-0c0.001 0 0.001 0 0.002 0 0.413 0 0.748-0.335 0.748-0.748 0-0.001 0-0.001 0-0.002v0-18c-0-0.268-0.141-0.503-0.352-0.636l-0.003-0.002zM21.246 22c-0.001 0.69-0.56 1.249-1.25 1.25h-15.996c-0.69-0.001-1.249-0.56-1.25-1.25v-12.001c0.001-0.69 0.56-1.249 1.25-1.25h15.996c0.69 0.001 1.249 0.56 1.25 1.25v12.001zM29.25 23.787l-6.504-3.25v-9.073l6.504-3.251z">
                                            </path>
                                        </g>
                                    </svg>
                                    My Courses
                                </a>
                            </li>
                            <li>
                                <a href="#" style="align-items: center; display: flex;">
                                    <svg width="25" height="25" viewBox="0 0 1024 1024" class="icon"
                                        version="1.1" xmlns="http://www.w3.org/2000/svg" fill="#000000"
                                        style="margin-right: 10px;">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M585.1 640.1V823l164.6 91.4L914.3 823V640.1l-164.6-91.4-164.6 91.4z m256 139.9l-91.4 50.8-91.4-50.8v-96.8l91.4-50.8 91.4 50.8V780z"
                                                fill="#0F1F3C"></path>
                                            <path
                                                d="M713.600676 737.454004a36.6 36.6 0 1 0 72.255718-11.719697 36.6 36.6 0 1 0-72.255718 11.719697Z"
                                                fill="#0F1F3C"></path>
                                            <path d="M109.7 109.7v804.6h438.9v-73.2H182.9V182.9h658.3V512h73.1V109.7z"
                                                fill="#0F1F3C"></path>
                                            <path
                                                d="M694.9 380.9v58H768V256H585.2v73.1h58L507.3 464.9l-109.7-73.1-167.4 167.5 51.7 51.7L407 485.9l109.7 73.2zM256 694.9h256V768H256z"
                                                fill="#0F1F3C"></path>
                                        </g>
                                    </svg>
                                    Sales History
                                </a>
                            </li>
                            <li>
                                <a href="#" style="align-items: center; display: flex;">
                                    <svg width="30" height="30" fill="#000000" viewBox="0 0 64 64"
                                        xmlns="http://www.w3.org/2000/svg" style="margin-right:10px;">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <g data-name="39 live chat" id="_39_live_chat">
                                                <path
                                                    d="M53.72,11.02H28.65c-3.74,0-6.78,2.5-6.78,5.57v2.39H9.73c-3.44,0-6.23,2.3-6.23,5.13V39.93c0,2.83,2.79,5.13,6.23,5.13h2.42l8.21,7.65a.977.977,0,0,0,.68.27.953.953,0,0,0,.4-.08,1.011,1.011,0,0,0,.6-.92V45.06H32.35c3.44,0,6.23-2.3,6.23-5.13V39.7h1.6v7.76a1,1,0,0,0,.61.92.881.881,0,0,0,.39.08,1.039,1.039,0,0,0,.69-.26L51,39.7h2.72c3.74,0,6.78-2.5,6.78-5.58V16.59C60.5,13.52,57.46,11.02,53.72,11.02ZM36.58,39.93c0,1.7-1.94,3.13-4.23,3.13H21.04a1,1,0,0,0-1,1v5.62l-6.82-6.35a1,1,0,0,0-.68-.27H9.73c-2.33,0-4.23-1.4-4.23-3.13V24.11c0-1.72,1.9-3.13,4.23-3.13H21.87V34.12c0,3.08,3.04,5.58,6.78,5.58h7.93ZM58.5,34.12c0,1.97-2.15,3.58-4.78,3.58H50.6a1.014,1.014,0,0,0-.68.26l-7.74,7.21V38.7a.99.99,0,0,0-1-1H28.65c-2.63,0-4.78-1.61-4.78-3.58V16.59c0-1.97,2.15-3.57,4.78-3.57H53.72c2.63,0,4.78,1.6,4.78,3.57Z">
                                                </path>
                                                <path
                                                    d="M31.11,21.44a3.745,3.745,0,1,0,3.75,3.75A3.751,3.751,0,0,0,31.11,21.44Zm0,5.49a1.745,1.745,0,1,1,1.75-1.74A1.75,1.75,0,0,1,31.11,26.93Z">
                                                </path>
                                                <path
                                                    d="M41.18,21.44a3.745,3.745,0,1,0,3.75,3.75A3.749,3.749,0,0,0,41.18,21.44Zm0,5.49a1.745,1.745,0,1,1,1.75-1.74A1.741,1.741,0,0,1,41.18,26.93Z">
                                                </path>
                                                <path
                                                    d="M51.26,21.44a3.745,3.745,0,1,0,3.75,3.75A3.751,3.751,0,0,0,51.26,21.44Zm0,5.49a1.745,1.745,0,1,1,1.75-1.74A1.743,1.743,0,0,1,51.26,26.93Z">
                                                </path>
                                            </g>
                                        </g>
                                    </svg>
                                    Support
                                </a>
                            </li>
                            <li>
                                <a href="#" style="align-items: center; display: flex;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 20 20" id="profile" style="margin-right:10px;">
                                        <g fill="none" fill-rule="evenodd" stroke="#200E32"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            transform="translate(4 2.5)">
                                            <circle cx="7.579" cy="4.778" r="4.778"></circle>
                                            <path
                                                d="M5.32907052e-15,16.2013731 C-0.00126760558,15.8654831 0.0738531734,15.5336997 0.219695816,15.2311214 C0.677361723,14.3157895 1.96797958,13.8306637 3.0389178,13.610984 C3.81127745,13.4461621 4.59430539,13.3360488 5.38216724,13.2814646 C6.84083861,13.1533327 8.30793524,13.1533327 9.76660662,13.2814646 C10.5544024,13.3366774 11.3373865,13.4467845 12.1098561,13.610984 C13.1807943,13.8306637 14.4714121,14.270023 14.929078,15.2311214 C15.2223724,15.8479159 15.2223724,16.5639836 14.929078,17.1807781 C14.4714121,18.1418765 13.1807943,18.5812358 12.1098561,18.7917621 C11.3383994,18.9634099 10.5550941,19.0766219 9.76660662,19.1304349 C8.57936754,19.2310812 7.38658584,19.2494317 6.19681255,19.1853548 C5.92221301,19.1853548 5.65676678,19.1853548 5.38216724,19.1304349 C4.59663136,19.077285 3.8163184,18.9640631 3.04807112,18.7917621 C1.96797958,18.5812358 0.686515041,18.1418765 0.219695816,17.1807781 C0.0745982583,16.8746908 -0.000447947969,16.5401098 5.32907052e-15,16.2013731 Z">
                                            </path>
                                        </g>
                                    </svg>
                                    Profile
                                </a>
                            </li>
                            <li>
                                <a href="#" style="align-items: center; display: flex;">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20"
                                        height="20" viewBox="0 0 50 50" style="margin-right:10px;">
                                        <path
                                            d="M 22.205078 2 A 1.0001 1.0001 0 0 0 21.21875 2.8378906 L 20.246094 8.7929688 C 19.076509 9.1331971 17.961243 9.5922728 16.910156 10.164062 L 11.996094 6.6542969 A 1.0001 1.0001 0 0 0 10.708984 6.7597656 L 6.8183594 10.646484 A 1.0001 1.0001 0 0 0 6.7070312 11.927734 L 10.164062 16.873047 C 9.583454 17.930271 9.1142098 19.051824 8.765625 20.232422 L 2.8359375 21.21875 A 1.0001 1.0001 0 0 0 2.0019531 22.205078 L 2.0019531 27.705078 A 1.0001 1.0001 0 0 0 2.8261719 28.691406 L 8.7597656 29.742188 C 9.1064607 30.920739 9.5727226 32.043065 10.154297 33.101562 L 6.6542969 37.998047 A 1.0001 1.0001 0 0 0 6.7597656 39.285156 L 10.648438 43.175781 A 1.0001 1.0001 0 0 0 11.927734 43.289062 L 16.882812 39.820312 C 17.936999 40.39548 19.054994 40.857928 20.228516 41.201172 L 21.21875 47.164062 A 1.0001 1.0001 0 0 0 22.205078 48 L 27.705078 48 A 1.0001 1.0001 0 0 0 28.691406 47.173828 L 29.751953 41.1875 C 30.920633 40.838997 32.033372 40.369697 33.082031 39.791016 L 38.070312 43.291016 A 1.0001 1.0001 0 0 0 39.351562 43.179688 L 43.240234 39.287109 A 1.0001 1.0001 0 0 0 43.34375 37.996094 L 39.787109 33.058594 C 40.355783 32.014958 40.813915 30.908875 41.154297 29.748047 L 47.171875 28.693359 A 1.0001 1.0001 0 0 0 47.998047 27.707031 L 47.998047 22.207031 A 1.0001 1.0001 0 0 0 47.160156 21.220703 L 41.152344 20.238281 C 40.80968 19.078827 40.350281 17.974723 39.78125 16.931641 L 43.289062 11.933594 A 1.0001 1.0001 0 0 0 43.177734 10.652344 L 39.287109 6.7636719 A 1.0001 1.0001 0 0 0 37.996094 6.6601562 L 33.072266 10.201172 C 32.023186 9.6248101 30.909713 9.1579916 29.738281 8.8125 L 28.691406 2.828125 A 1.0001 1.0001 0 0 0 27.705078 2 L 22.205078 2 z M 23.056641 4 L 26.865234 4 L 27.861328 9.6855469 A 1.0001 1.0001 0 0 0 28.603516 10.484375 C 30.066026 10.848832 31.439607 11.426549 32.693359 12.185547 A 1.0001 1.0001 0 0 0 33.794922 12.142578 L 38.474609 8.7792969 L 41.167969 11.472656 L 37.835938 16.220703 A 1.0001 1.0001 0 0 0 37.796875 17.310547 C 38.548366 18.561471 39.118333 19.926379 39.482422 21.380859 A 1.0001 1.0001 0 0 0 40.291016 22.125 L 45.998047 23.058594 L 45.998047 26.867188 L 40.279297 27.871094 A 1.0001 1.0001 0 0 0 39.482422 28.617188 C 39.122545 30.069817 38.552234 31.434687 37.800781 32.685547 A 1.0001 1.0001 0 0 0 37.845703 33.785156 L 41.224609 38.474609 L 38.53125 41.169922 L 33.791016 37.84375 A 1.0001 1.0001 0 0 0 32.697266 37.808594 C 31.44975 38.567585 30.074755 39.148028 28.617188 39.517578 A 1.0001 1.0001 0 0 0 27.876953 40.3125 L 26.867188 46 L 23.052734 46 L 22.111328 40.337891 A 1.0001 1.0001 0 0 0 21.365234 39.53125 C 19.90185 39.170557 18.522094 38.59371 17.259766 37.835938 A 1.0001 1.0001 0 0 0 16.171875 37.875 L 11.46875 41.169922 L 8.7734375 38.470703 L 12.097656 33.824219 A 1.0001 1.0001 0 0 0 12.138672 32.724609 C 11.372652 31.458855 10.793319 30.079213 10.427734 28.609375 A 1.0001 1.0001 0 0 0 9.6328125 27.867188 L 4.0019531 26.867188 L 4.0019531 23.052734 L 9.6289062 22.117188 A 1.0001 1.0001 0 0 0 10.435547 21.373047 C 10.804273 19.898143 11.383325 18.518729 12.146484 17.255859 A 1.0001 1.0001 0 0 0 12.111328 16.164062 L 8.8261719 11.46875 L 11.523438 8.7734375 L 16.185547 12.105469 A 1.0001 1.0001 0 0 0 17.28125 12.148438 C 18.536908 11.394293 19.919867 10.822081 21.384766 10.462891 A 1.0001 1.0001 0 0 0 22.132812 9.6523438 L 23.056641 4 z M 25 17 C 20.593567 17 17 20.593567 17 25 C 17 29.406433 20.593567 33 25 33 C 29.406433 33 33 29.406433 33 25 C 33 20.593567 29.406433 17 25 17 z M 25 19 C 28.325553 19 31 21.674447 31 25 C 31 28.325553 28.325553 31 25 31 C 21.674447 31 19 28.325553 19 25 C 19 21.674447 21.674447 19 25 19 z">
                                        </path>
                                    </svg>
                                    Settings
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo e(url('/logout')); ?>"
                                    style="align-items: center; display: flex; color:red;">
                                   
                                    <svg fill="#e41111" height="20" width="20" version="1.1" id="Capa_1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        viewBox="0 0 384.971 384.971" xml:space="preserve"
                                        style="margin-right: 10px;">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <g>
                                                <g id="Sign_Out">
                                                    <path
                                                        d="M180.455,360.91H24.061V24.061h156.394c6.641,0,12.03-5.39,12.03-12.03s-5.39-12.03-12.03-12.03H12.03 C5.39,0.001,0,5.39,0,12.031V372.94c0,6.641,5.39,12.03,12.03,12.03h168.424c6.641,0,12.03-5.39,12.03-12.03 C192.485,366.299,187.095,360.91,180.455,360.91z">
                                                    </path>
                                                    <path
                                                        d="M381.481,184.088l-83.009-84.2c-4.704-4.752-12.319-4.74-17.011,0c-4.704,4.74-4.704,12.439,0,17.179l62.558,63.46H96.279 c-6.641,0-12.03,5.438-12.03,12.151c0,6.713,5.39,12.151,12.03,12.151h247.74l-62.558,63.46c-4.704,4.752-4.704,12.439,0,17.179 c4.704,4.752,12.319,4.752,17.011,0l82.997-84.2C386.113,196.588,386.161,188.756,381.481,184.088z">
                                                    </path>
                                                </g>
                                                <g> </g>
                                                <g> </g>
                                                <g> </g>
                                                <g> </g>
                                                <g> </g>
                                                <g> </g>
                                            </g>
                                        </g>
                                    </svg>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </nav>
    
<?php endif; ?>

<?php $__env->startPush('scripts_bottom'); ?>
    <script src="/assets/default/js/parts/navbar.min.js"></script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/u195145987/domains/swanirbhar.org.in/public_html/resources/views/web/default/includes/navbar.blade.php ENDPATH**/ ?>