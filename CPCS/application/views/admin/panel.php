<div class="row">
    <div class="large-12 columns content">
        <h3 class="page-title">Blog Management</h3>
        <ul class="accordion" data-accordion>
            <li class="accordion-navigation">
                <a href="#panel1b"><i class="fa fa-plus-circle"></i> New Blog Post</a>
              <div id="panel1b" class="content active">
                          <form id="create_post" name="create_post" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/admin/blog_posts/create_post" method="POST">
                          <div class="errors"></div>
                          <legend>
                              <div class="row">
                                <label for="post_title">Post Title</label> <input type="text" name="post_title" /> 
                              </div>
                              <div class="row">
                                <label for="post_author">Post Author</label> <input type="text" name="post_author" /> 
                              </div>
                              <div class="row">
                                    <label for="publish_status">Publish</label>
                                    <input type="radio" name="publish_status" value="1"> Draft</option>
                                    <input type="radio" name="publish_status" value="2"> Live</option>
                              </div>
                              <div class="row">
                                   <textarea name="post_content" id="content">Your blog post goes here...</textarea>
                                    <?php echo display_ckeditor($ckeditor); ?>
                              </div>
                              <div class="row">
                                    <label for="post_img">Post Banner</label> <input type="file" name="post_img" />
                              </div>
                              <div class="row">
                                    <button type="submit" class="button-bar">Create Blog Post</button>
                              </div>
                          </legend>
                      </form>
              </div>
            </li>
            <li class="accordion-navigation">
              <a href="#panel2a"><i class="fa fa-edit"></i> Edit Blog Post</a>
              <div id="panel2a" class="content">

              </div>
            </li>
            <li class="accordion-navigation">
              <a href="#panel2a"><i class="fa fa-trash"></i> Delete Blog Post</a>
              <div id="panel2a" class="content">

              </div>
            </li>
          </ul>
        
        <h3 class="page-title">Pest Management</h3>
        <ul class="accordion" data-accordion>
            <li class="accordion-navigation">
              <a href="#panel1a"><i class="fa fa-plus-circle"></i> Create New Pest</a>
              <div id="panel1a" class="content">
                          <form id="create_pest" name="create_pest" enctype="multipart/form-data"action="<?php echo base_url(); ?>index.php/admin/common_pests/create_pest" method="POST">
                          <div class="errors"></div>
                          <legend>
                              <div class="row">
                                <label for="pest_name">Pest Name</label> <input type="text" name="pest_name" /> 
                              </div>
                              <div class="row">
                                <label for="pest_class">Pest Class</label> <input type="text" name="pest_class" /> 
                              </div>
                              <div class="row">
                                    <label for="pest_season">Pest Season</label>
                                    <input type="checkbox" name="pest_season[]" value="1"> Spring</option>
                                    <input type="checkbox" name="pest_season[]" value="2"> Summer</option>
                                    <input type="checkbox" name="pest_season[]" value="3"> Fall</option>
                                    <input type="checkbox" name="pest_season[]" value="4"> Winter</option>
                              </div>
                              <div class="row">
                                    <label for="pest_description">Pest Description</label> <input type="text" name="pest_description" /> 
                              </div>
                              <div class="row">
                                    <label for="pest_img">Pest Image</label> <input type="file" name="pest_img" />
                              </div>
                              <div class="row">
                                    <button type="submit" class="button-bar">Add Pest</button>
                              </div>
                          </legend>
                      </form>
              </div>
            </li>
            <li class="accordion-navigation">
              <a href="#panel2a"><i class="fa fa-edit"></i> Modify Pests</a>
              <div id="panel2a" class="content">
                  <?php foreach($pests as $pest): ?>
                  
                  <?php endforeach; ?>
              </div>
            </li>
            <li class="accordion-navigation">
              <a href="#panel2a"><i class="fa fa-trash"></i> Delete a Pest</a>
              <div id="panel2a" class="content">

              </div>
            </li>
          </ul>
</div>