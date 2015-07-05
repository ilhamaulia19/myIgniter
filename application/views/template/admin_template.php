<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="keyword" content="Codeigniter, bootstrap, Grocerycrud">
    <meta name="description" content="Custom Framework Codeigniter and bootstrap">
    <meta name="author" content="Asrul Hanafi">
    <title><?php echo $title ?></title>
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url('assets/img//favicon-96x96.png') ?>">
   
    <script src="<?php echo base_url('assets/js/pace.min.js') ?>"></script>
    <script type="text/javascript">paceOptions={elements:true};</script> 
    <!--GroceryCRUD CSS-->
    <?php if (isset($css_files)) : ?>
        <?php foreach($css_files as $file): ?>
            <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
        <?php endforeach; ?>
    <?php endif ?>
    <!--Bootstrap-->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <!--Font-->
    <link href="<?php echo base_url('assets/css/font-awesome.min.css') ?>" rel="stylesheet">
    <!--AdminLTE-->
    <link href="<?php echo base_url('assets/css/AdminLTE.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/skins/_all-skins.min.css') ?>" rel="stylesheet">
    <!--Alertify-->
    <link href="<?php echo base_url('assets/css/alertify.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/default.min.css') ?>" rel="stylesheet">
    <!--CSS PLUGINS-->
    <?php if (isset($css_plugins)): ?>
        <?php foreach ($css_plugins as $url_plugin): ?>
            <link href="<?php echo base_url("$url_plugin") ?>" rel="stylesheet">
        <?php endforeach ?>
    <?php endif ?>
    <!--Custom CSS-->
    <link href="<?php echo base_url('assets/css/a-design.css') ?>" rel="stylesheet">
</head>
<body class="<?php echo $settings->skin ?> fixed sidebar-collapse">

<!-- Site wrapper -->
<div class="wrapper">  
    <header class="main-header">
        <a href="<?php echo site_url('crud/index') ?>" class="logo">
           <span class="logo-mini"><b>M</b>I</span>
           <span class="logo-lg"><b>My</b>Igniter</span>
        </a>

        <nav class="navbar navbar-static-top" role="navigation">
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu" >
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?php echo base_url('assets/img/logo/khotaxdev.png') ?>" class="user-image" alt="User Image"/>
                            <span class="hidden-xs"><?php echo $this->ion_auth->user()->row()->username ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-header">
                                <img src="<?php echo base_url('assets/img/logo/khotaxdev.png') ?>" class="img-circle" alt="User Image" />
                                <p>
                                  <?php echo $this->ion_auth->user()->row()->first_name ?> <?php echo $this->ion_auth->user()->row()->last_name ?>
                                  <small><?php echo date('d-F-Y') ?></small>
                                </p>
                            </li>
                            <li class="user-footer no-padding">
                                <a href="<?php echo  site_url('auth/logout')?>" class="btn btn-default btn-flat">Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <aside class="main-sidebar">
        <section class="sidebar" id="menuSidebar">
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" class="form-control searchlist" id="searchSidebar" placeholder="Search..." autocomplete="off"/>
                    <span class="input-group-btn">
                        <button type='button' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </form>
            <ul class="sidebar-menu list" id="menuList">
            </ul>
            <ul class="sidebar-menu list" id="menuSub">
                <?php foreach ($header_menu->result() as $header): ?>
                    <li class="header"><?php echo $header->header ?></li>
                    <?php foreach ($menu->result() as $key => $menu_item): ?>
                        <?php if ($header->id_header_menu == $menu_item->id_header_menu): ?>
                            <?php if ($menu_item->url == "#" && $menu_item->level_one == "0") { ?>
                                <li class="treeview">
                                    <a href="#"><i class="fa fa-<?php echo $menu_item->icon ?>"></i> <span><?php echo $menu_item->label ?></span> <i class="fa fa-angle-left pull-right"></i></a>
                                    <ul class="treeview-menu">
                                        <?php foreach ($menu_lvlOne->result() as $lvlOne): ?>
                                            <?php if ($menu_item->id_menu == $lvlOne->level_one): ?>                                        
                                                <?php if ($lvlOne->url == "#") { ?>
                                                    <li>
                                                        <a href="#"><i class="fa fa-<?php echo $lvlOne->icon ?>"></i> <span><?php echo $lvlOne->label ?></span> <i class="fa fa-angle-left pull-right"></i></a>
                                                        <ul class="treeview-menu level-2">
                                                            <?php foreach ($menu_lvlTwo->result() as $lvlTwo): ?>
                                                                <?php if ($lvlOne->id_menu == $lvlTwo->level_two): ?>
                                                                    <li id="<?php echo $lvlTwo->menu_id ?>"><a href="<?php echo site_url($lvlTwo->url) ?>" class="name"><i class="fa fa-<?php echo $lvlTwo->icon ?>" class="name"></i> <?php echo $lvlTwo->label ?></a></li>
                                                                <?php endif ?>                                    
                                                            <?php endforeach ?>
                                                        </ul>
                                                    </li>
                                                <?php }else{ ?>
                                                    <li id="<?php echo $lvlOne->menu_id ?>"><a href="<?php echo site_url($lvlOne->url) ?>" class="name"><i class="fa fa-<?php echo $lvlOne->icon ?>" class="name"></i> <?php echo $lvlOne->label ?></a></li>
                                                <?php } ?>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    </ul>
                                </li>
                            <?php }else{ ?>
                                <li id="<?php echo $menu_item->menu_id ?>"><a href="<?php echo site_url($menu_item->url) ?>" class="name"><i class="fa fa-<?php echo $menu_item->icon ?>"></i> <span><?php echo $menu_item->label ?></span></a></li>
                            <?php } ?>
                        <?php endif ?>
                    <?php endforeach ?>
                <?php endforeach ?>
            </ul>
        </section>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $judul ?>
          </h1>
          <ol class="breadcrumb">
            <?php if (!isset($crumb)){ ?>
                <li class="active">
                    <i class="fa fa-dashboard"></i> Dashboard
                </li>            
            <?php }else{ ?>
                <li>
                    <a href="<?php echo site_url('crud/index') ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
                </li>            
                <?php foreach ($crumb as $label => $link): ?>
                    <?php if ($link == ''){ ?>
                        <?php 
                            $add_crumb = strpos(current_url(), '/add');
                            $edit_crumb = strpos(current_url(), '/edit');
                            $read_crumb = strpos(current_url(), '/read');
                            if ($add_crumb || $edit_crumb || $read_crumb) {
                        ?>
                            <li>
                                <?php 
                                    if ($add_crumb) {
                                        $part_link = str_replace('/add', '', current_url());
                                        $label_new = 'Add';
                                    }
                                    if ($edit_crumb) {
                                        $part_link = strstr(current_url(), '/edit', true);
                                        $label_new = 'Edit';
                                    }
                                    if ($read_crumb) {
                                        $part_link = strstr(current_url(), '/read', true);
                                        $label_new = 'Read';
                                    }
                                ?>
                                <a href="<?php echo $part_link ?>"><?php echo $label ?></a>
                            </li>
                            <li class="active">
                                <?php echo $label_new ?>
                            </li>
                        <?php }else{ ?>
                            <li class="active">
                                <?php echo $label ?>
                            </li>
                        <?php } ?>
                    <?php }else{ ?>
                        <li>
                            <a href="<?php echo site_url($link) ?>"> <?php echo $label ?></a>
                        </li>            
                    <?php } ?>
                <?php endforeach ?>
            <?php } ?>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content exspan-bottom">
            <div id="announcement"></div>
            <?php echo $page ?>
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 3.3  
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="#">Asrul Hanafi</a>.</strong> All rights reserved.
    </footer>
</div><!-- ./wrapper -->

<!-- GroceryCRUD JS -->
<?php if (isset($js_files)) { foreach($js_files as $file): ?> 
    <script src="<?php echo $file; ?>"></script>
<?php endforeach; } else { ?>
    <script src="<?php echo base_url('assets/js/plugins/jQuery/jQuery-2.1.4.min.js') ?>"></script>             
<?php } ?>       
<!--JS Plugins-->
<?php if (isset($js_plugins)): ?>
    <?php foreach ($js_plugins as $url_plugin): ?>
        <script src="<?php echo base_url($url_plugin) ?>"></script>                
    <?php endforeach ?>
<?php endif ?>
<!--Bootstrap JS-->
<script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
<!--Alertify JS-->
<script src="<?php echo base_url('assets/js/alertify.min.js') ?>"></script>
<!--AdminLTE JS-->
<script src="<?php echo base_url('assets/js/plugins/slimScroll/jquery.slimScroll.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/plugins/fastclick/fastclick.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/app.min.js') ?>"></script>
<script>
    site         = '<?php echo site_url(); ?>';
    ur_class     = '<?php echo $this->uri->segment(1); ?>';
    url_function = '<?php echo $this->uri->segment(2); ?>';
    <?php echo isset($script) ? $script : '' ?>
    function datatablesOptions() { var option = { <?php echo isset($data['script_datatables']) ? $data['script_datatables'] : ''  ?> }; return option; }
    function afterDatatables() { <?php echo isset($data['script_grocery']) ? $data['script_grocery']: '' ?> }
</script>
<script src="<?php echo base_url('assets/js/list.min.js') ?>"></script>
<!--Custom JS-->
<script src="<?php echo base_url('assets/js/a-design.js') ?>"></script>
</body>
</html>