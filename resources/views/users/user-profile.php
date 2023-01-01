<section class="profile">
    <div class="profile_box">
      <div class="left">
        <div class="info">
                <div class="height-card">
                            <div>
                                <p class="mb-0">Name: <?= $data->info->display_name ?></p>
                            </div>
                        <hr>
                        
                            <div>
                                <p class="text-muted1 mb-0" >Username: <?= $data->info->username ?></p>
                            </div>
                        <hr>
                        
                            <div>
                                <p class="text-muted1 mb-0">Email: <?= $data->info->email ?></p>
                            </div>
                        <hr>
                        
                            <div>
                                <p class="text-muted1 mb-0" >Created At: <?= $data->info->created_at ?></p>
                            </div>
                        <hr>
                            <div>
                                <p class="text-muted1 mb-0">Updated At: <?= $data->info->updated_at ?></p>
                            </div>
                        <hr>
                            <div class="col-sm-9 mt-5">
                              <a href="/users/edit_profile?id=<?= $data->info->id ?>"><button class="button-85" role="button">Edit Profile</button></a>
                            </div>
                            
                </div>
        </div>
      </div>
      <div class="right">
        <img src="<?=$_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST']?>/resources/Images/<?= $data->info->img ?>">
      </div>
    </div>
  </section>