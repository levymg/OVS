<div class="row">
    <div class="large-8 columns content">
            <h3 class="page-title">CPCS Blog</h3>
            <?php foreach($posts as $post => $p): ?>
            <div class="large-8 columns">
                    <h3 class="post-title"><?php echo $p->post_title; ?></h3>
                    <h5>Posted by <em><?php echo $p->post_author; ?></em> on <em><?php echo date("m.d.Y", $p->created_on); ?></em></h5>
                    <p><?php echo $p->post_content; ?></p>
                    <a class="button button-bar" href="blog/<?php echo $p->post_title; ?>">Read more</a>
            </div>
            <div class="large-4 columns">
                <img src="<?php echo base_url(); ?>assets/admin/blog_img/<?php echo $p->post_img; ?>" class="responsive-img" alt="<?php echo $p->post_title; ?>" />
            </div>
            <hr class="rule" />
            <?php endforeach; ?>
    </div>
   