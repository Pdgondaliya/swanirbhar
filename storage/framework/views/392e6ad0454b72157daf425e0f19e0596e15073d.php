<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h1><?php echo e(trans('admin/main.settings')); ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#"><?php echo e(trans('admin/main.dashboard')); ?></a></div>
                <div class="breadcrumb-item"><?php echo e(trans('admin/main.settings')); ?></div>
            </div>
        </div>

        <div class="section-body">
         
            <div class="row">

                         
                    <div class="col-lg-12">
                      
                        <div class="empty-state mx-auto d-block"  data-width="900" >
                                <img class="img-fluid col-md-6" src="/assets/default/img/lic.svg" alt="image">
                                <h3 class="mt-3">Please activate your license!</h3>
                                <h5 class="lead">
                                You can activate your license by <strong><a href="mailto:rocketsoftsolutions@gmail.com">contacting support</a></strong> or checking <strong><a href="https://crm.rocket-soft.org">CRM</a></strong>  </h5>                              </p>
                              </div>
                      
                      
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-list-alt"></i>
                            </div>
                            <div class="card-body">
                                <h4>Activate License</h4>
                                <p>You can get Your license file form <strong><a href="https://crm.rocket-soft.org">CRM</a></strong>.</p>
                                <a href="<?php echo e(getAdminPanelUrl("/settings/update-app")); ?>" class="card-cta text-primary">Install License<i class="fas fa-upload"></i></a>
                            </div>
                        </div>
                    </div>
               
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u195145987/domains/swanirbhar.org.in/public_html/resources/views/admin/settings/index.blade.php ENDPATH**/ ?>