
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            DETAIL DATA PENDAFTAR
          </h1>

        <!-- Main content -->

          <section class="content">
          <div class="row">
            <div class="col-xs-14">

              <div class="box">
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Universitas</th>
                        <th>Fakultas</th>
                        <th>Jurusan</th>
                        <th>Alamat</th>
                        <th>Kategori</th>
                        <th>Tanggal Masuk</th>
                        <th>Tanggal Keluar</th>
                        <th>Nama Unit</th>
                        <th>Nama Divisi</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                      </tr>
                    </thead>
                    <?php foreach ($pengaju as $p) : ?>
                      <tbody>
                      <tr>
                        <td><?= $p[0]['universitas'];?></td>
                        <td><?= $p[0]['fakultas'];?></td>
                        <td><?= $p[0]['jurusan'];?></td>
                        <td><?= $p[0]['alamat'];?></td>
                        <td><?= $p[0]['nama_kategori'];?></td>
                        <td><?= $p[0]['tanggal_masuk'];?></td>
                        <td><?= $p[0]['tanggal_keluar'];?></td>
                        <td><?= $p[0]['nama_unit'];?></td>
                        <td><?= $p[0]['nama_divisi'];?></td>
                        <?php  if ($p[0]['status']==''): ?>
                            <td> </td>
                               <?php  elseif ($p[0]['status']=='1'): ?>
                                <td> <span class="label label-success">Di Terima</span></td>
                             <?php  else: ?>
                              <td>  <span class="label label-danger">Di Tolak</span> </td>
                            <?php endif; ?>


                         <?php foreach ($peserta as $l) : ?>
                        <td><a href="<?=base_url(); ?>admin/status_terima/<?= $l['id_pengaju'];?>" class="btn btn-info btn-sm ">Terima</a> 
                           <a href="<?=base_url(); ?>admin/status_tolak/<?= $l['id_pengaju'];?>" class="btn btn-info btn-sm ">Tolak </a> </td>
                    <?php endforeach  ?>

                      </tr>
                      </tbody>
                      <?php endforeach  ?>
                     </table>
                   </div>
                 </div>
               </div>
             </div>


             <div class="row">
            <div class="col-xs-13">
              <div class="box">
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Nama Mahasiswa</th>
                        <th>No. Induk Mahasiswa</th>
                        <th>Email</th>
                        <th>No. Handphone</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($peserta as $p): ?> 
                      <tr>
                        <td><?= $p['nama'];?></td>
                        <td><?= $p['nim'];?></td>
                        <td><?= $p['email'];?></td>
                        <td><?= $p['nomorhp'];?></td>
                      </tr>
                      <?php endforeach ?>
                    </tbody>
                     </table>
                   </div>
                 </div>
               </div>
             </div>
        </section>
        

        <!-- /.content -->
      
