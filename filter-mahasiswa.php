<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel">Filter Data Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="index.php" method="get">
                    <div class="mb-3">
                        <label for="angkatanFilter" class="form-label">Tahun Penerimaan</label>
                        <select class="form-select" id="angkatanFilter" name="angkatan">
                            <option value="">Semua</option>
                            <?php
                            $angkatanOptions = getFilterOptions()['angkatan'];
                            foreach ($angkatanOptions as $option) {
                                echo "<option value=\"$option\"";
                                echo ($filters['angkatan'] === $option) ? 'selected' : '';
                                echo ">$option</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jurusanFilter" class="form-label">Jurusan</label>
                        <select class="form-select" id="jurusanFilter" name="jurusan">
                            <option value="">Semua</option>
                            <option value="081">Informatika</option>
                            <option value="082">Sistem Informasi</option>
                            <option value="083">Sains Data</option>
                            <option value="084">Bisnis Digital</option>
                            <!-- Add more options as needed for other faculties and majors -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="genderFilter" class="form-label">Gender</label>
                        <select class="form-select" id="genderFilter" name="gender">
                            <option value="">Semua</option>
                            <option value="Pria">Pria</option>
                            <option value="Wanita">Wanita</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="kotaFilter" class="form-label">Asal Kota/Kabupaten</label>
                        <select class="form-select" id="kotaFilter" name="alamat">
                            <option value="">Semua</option>
                            <?php
                            $filterOptions = getFilterOptions();
                            foreach ($filterOptions['kota'] as $option) {
                                $selected = ($kotaFilter === $option) ? 'selected' : '';
                                echo "<option value=\"$option\" $selected>$option</option>";
                            }
                            
                            ?>
                        </select>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                    <!-- Filter and Cancel Buttons -->
                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal">Batal</button>
                        </div>

                    <!-- Reset Filter Button (moved to the right) -->
                    <button type="button" class="btn btn-outline-secondary" onclick="resetFilter()">Reset Filter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
