<!-- <section>
    <div class="article-clean">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-xl-8 offset-lg-1 offset-xl-2">
                    <div class="intro">
                        <h1 class="text-center"><?= $blog->title; ?></h1>
                        <p class="text-center"><span class="by">by</span> <?= $blog->writer; ?><span class="date"><?= date('d F Y', strtotime($blog->created_at)); ?> </span></p>
                        <div class="text content-blog">
                            <?= $blog->content; ?>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
<section id="wrapper" style="margin-top:0">
            <header style="padding-bottom:1px;z-index:100;">
                <div class="inner">
                    <h2><?= $blog->title; ?></h2>
                    <!-- <p>Phasellus non pulvinar erat. Fusce tincidunt nisl eget ipsum.</p> -->
                    <!-- <p><?= $blog->writer; ?></p> -->
                    <p><?= date('d F Y', strtotime($blog->created_at)); ?></p>
                </div>
            </header>
            <div class="wrapper" style="z-index:10">
                <div class="inner" style="padding-top:10px">
                    <!-- <section> -->
                        <!-- <h4>Left &amp; Right</h4> -->
                        <div class="col-12">
                        <!-- <span class="image fit"><img src="images/pic08.jpg" alt="" /></span>
                        <p align="justify">Morbi mattis mi consectetur tortor elementum, varius pellentesque velit convallis. Aenean tincidunt lectus auctor mauris maximus, ac scelerisque ipsum tempor. Duis vulputate ex et ex tincidunt, quis lacinia velit aliquet. Duis non efficitur nisi, id malesuada justo. Maecenas sagittis felis ac sagittis semper. Curabitur purus leo, tempus sed finibus eget, fringilla quis risus. Maecenas et lorem quis sem varius sagittis et a est. Maecenas iaculis iaculis sem. Donec vel dolor at arcu tincidunt bibendum. Interdum et malesuada fames ac ante ipsum primis in faucibus. Fusce ut aliquet justo. Donec id neque ipsum. Integer eget ultricies odio. Nam vel ex a orci fringilla tincidunt. Aliquam eleifend ligula non velit accumsan cursus. Etiam ut gravida sapien. Morbi mattis mi consectetur tortor elementum, varius pellentesque velit convallis. Aenean tincidunt lectus auctor mauris maximus, ac scelerisque ipsum tempor. Duis vulputate ex et ex tincidunt, quis lacinia velit aliquet. Duis non efficitur nisi, id malesuada justo. Maecenas sagittis felis ac sagittis semper. Curabitur purus leo, tempus sed finibus eget, fringilla quis risus. Maecenas et lorem quis sem varius sagittis et a est. Maecenas iaculis iaculis sem. Donec vel dolor at arcu tincidunt bibendum. Interdum et malesuada fames ac ante ipsum primis in faucibus. Fusce ut aliquet justo. Donec id neque ipsum. Integer eget ultricies odio. Nam vel ex a orci fringilla tincidunt. Aliquam eleifend ligula non velit accumsan cursus. Etiam ut gravida sapien.
                        </p> -->
                        <?= $blog->content; ?>
                        </div>
                                            
                    <!-- </section> -->
                </div>
                
            </div>
            
        </section>