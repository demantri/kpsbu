<div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Profile Pegawai</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                        <div class="profile_img">
                            <div id="crop-avatar">
                            <!-- Current avatar -->
                            <img class="img-responsive avatar-view" src="<?= base_url('assets/production/images/user.png')?>" alt="Avatar" title="Change the avatar">
                            </div>
                        </div>
                        <h3><?= ucwords($user->nama) ?></h3>

                        <ul class="list-unstyled user_data">
                          <li><i class="fa fa-map-marker user-profile-icon"></i> <?= ucwords($user->alamat . ', Indonesia')?></li>
                          <li><i class="fa fa-briefcase user-profile-icon"></i> <?= ucwords('Pegawai '.$user->id_jenis_pegawai)?></li>
                          <li><?= 'Tgl. Bergabung : ' . $user->created_at ?></li>
                        </ul>

                        <a class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
                        <br>

                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="true">History Lembur</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Profile</a>
                          </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content2" aria-labelledby="profile-tab">
                            <!-- start user projects -->
                            <table class="data table table-striped no-margin">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>ID Pengajuan</th>
                                  <th>Tgl. Lembur</th>
                                  <th>Total Jam Lembur</th>
                                  <th>Status</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $no = 1; 
                                foreach ($lembur as $item) { ?>
                                <tr>
                                  <td><?= $no++ ?></td>
                                  <td><?= $item->id_pengajuan ?></td>
                                  <td><?= $item->tgl_pengajuan ?></td>
                                  <td><?= $item->total_jam ?></td>
                                  <td>
                                      <?= $item->status == 0 ? '<span class="label label-warning">Menunggu persetujuan</span>' : (($item->status == 1) ? '<span class="label label-success">Sudah disetujui</span>' : '<span class="label label-danger">Ditolak</span>'); ?>
                                  </td>
                                </tr>
                                <?php }?>
                              </tbody>
                            </table>
                            <!-- end user projects -->

                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                            <p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui
                              photo booth letterpress, commodo enim craft beer mlkshk </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>