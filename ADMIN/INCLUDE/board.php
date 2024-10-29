<?php
    include "config.php";
    $sql = mysqli_query($connection,"SELECT * FROM movie");
    //untuk menghitung total jumlah rows nya
    $jumlahd = mysqli_num_rows($sql);
	$sql = mysqli_query($connection,"SELECT * FROM cinema");
    //untuk menghitung total jumlah rows nya
    $jumlahh = mysqli_num_rows($sql);
	$sql = mysqli_query($connection,"SELECT * FROM kota");
    //untuk menghitung total jumlah rows nya
    $jumlahk = mysqli_num_rows($sql);
	$sql = mysqli_query($connection,"SELECT * FROM showtimes");
	//untuk menghitung total jumlah rows nya
    $jumlaht = mysqli_num_rows($sql);
?>                        

                        <div class="row">

                        <!--ini untuk membuat tampilannya sehingga memunculkan total rows-->
                        <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Jumlah Movie: 
                                        <?php echo $jumlahd; ?>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="d-daftardestinasi.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
							
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Jumlah Penayangan: 
										<?php echo $jumlaht; ?>
									</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="daftartransportasi.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Jumlah Cinema: 
										<?php echo $jumlahh; ?>
									</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="daftarhotel.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Jumlah Kota: 
										<?php echo $jumlahk; ?>
									</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="daftarkuliner.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>