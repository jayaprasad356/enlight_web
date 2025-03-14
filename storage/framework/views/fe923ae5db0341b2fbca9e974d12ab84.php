<?php
    use App\Models\Utility;
    $users = \Auth::user();

    $profile = \App\Models\Utility::get_file('uploads/avatar/');
   
    $unseen_count = DB::select('SELECT from_id, COUNT(*) AS totalmasseges FROM ch_messages WHERE seen = 0 GROUP BY from_id');
?>


<?php if(isset($setting['cust_theme_bg']) && $setting['cust_theme_bg'] == 'on'): ?>
    <header class="dash-header transprent-bg">
    <?php else: ?>
        <header class="dash-header">
<?php endif; ?>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<div class="header-wrapper">
    <div class="me-auto dash-mob-drp">
        <ul class="list-unstyled">
            <li class="dash-h-item mob-hamburger">
                <a href="#!" class="dash-head-link" id="mobile-collapse">
                    <div class="hamburger hamburger--arrowturn">
                        <div class="hamburger-box">
                            <div class="hamburger-inner"></div>
                        </div>
                    </div>
                </a>
            </li>

            <li class="dropdown dash-h-item drp-company">
    <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
        role="button" aria-haspopup="true" aria-expanded="false">
        <span class="theme-avtar">
        <?php if(session('avatar')): ?>
            <!-- Show user avatar if available -->
            <img alt="User Avatar" src="<?php echo e(asset('storage/app/public/avatar/' . session('avatar'))); ?>" 
                class="header-avtar"
                style="width: 100%; border-radius:50%">
        <?php else: ?>
            <!-- Show default avatar if no avatar exists -->
            <img alt="Default Avatar" src="<?php echo e(asset('storage/uploads/avatar/avatar.png')); ?>" 
                class="header-avtar"
                style="width: 100%; border-radius:50%">
        <?php endif; ?>
    </span>
        <span class="hide-mob ms-2"><?php echo e(__('Hi ') . session('user_name', 'Guest')); ?></span>
        <i class="ti ti-chevron-down drp-arrow nocolor hide-mob"></i>
    </a>

    <div class="dropdown-menu dash-h-dropdown">
    <a class="dropdown-item" href="<?php echo e(route('profile')); ?>">
    <i class="ti ti-user"></i>   <?php echo e(__('Profile')); ?>

                                    </a>

        <a href="<?php echo e(route('logout')); ?>" class="dropdown-item"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="ti ti-power"></i>
            <span><?php echo e(__('Logout')); ?></span>
        </a>
        
        <!-- Logout Form -->
        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
            <?php echo csrf_field(); ?>
        </form>
    </div>
</li>




        </ul>
    </div>
    <div class="ms-auto">
        <ul class="list-unstyled">

          

            <?php
                // $currantLang = basename(\App::getLocale());
                // $languages = \App\Models\Utility::languages();
                // $lang = isset($admins->lang) ? $admins->lang : 'en';
                // if ($lang == null) {
                //     $lang = 'en';
                // }
                // if (\Schema::hasTable('languages')) {
                //     $LangName = \App\Models\Languages::where('code', $lang)->first()->fullName;
                // } else {
                //     $LangName = 'english';
                // }

                $lang = isset($admins->lang) ? $admins->lang : 'en';
                if ($lang == null) {
                    $lang = 'en';
                }
                $LangName = \App\Models\Languages::where('code', $lang)->first()->fullName;
                if (empty($LangName)) {
                    $LangName = new App\Models\Utility();
                    $LangName->fullName = 'English';
                }
            ?>

         

        </ul>
    </div>
</div>
</header>
<?php $__env->startPush('scripts'); ?>
    
    <script>
        $('#msg-btn').click(function() {
            let contactsPage = 1;
            let contactsLoading = false;
            let noMoreContacts = false;
            $.ajax({
                url: url + "/getContacts",
                method: "GET",
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    page: contactsPage,
                    type: 'custom',
                },
                dataType: "JSON",
                success: (data) => {

                    if (contactsPage < 2) {
                        $(".count-listOfContacts").html(data.contacts);

                    } else {
                        $(".count-listOfContacts").append(data.contacts);
                    }
                    $('.count-listOfContacts').find('.messenger-list-item').each(function(e) {
                        $('.noti-body .activeStatus').remove()
                        $('.noti-body .avatar').remove()
                        $(this).find('span').remove()
                        $(this).find('p').addClass("d-inline")
                        // $(this).find('b').addClass('position-absolute')
                        // $(this).find('b').css({position: "absolute"});
                        $(this).find('b').css({
                            "position": "absolute",
                            "right": "50px"
                        });
                        $(this).find('tr').remove('td')

                    })
                },
                error: (error) => {
                    setContactsLoading(false);
                    console.error(error);
                },
            });
        })
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\enlight_web\resources\views/partial/Admin/header.blade.php ENDPATH**/ ?>