<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel">Filter Nilai Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="nilai_mahasiswa.php" method="get">
                    <!-- Lebih Besar Dari -->
                    <div class="mb-3 custom-form">
                        <label for="tugasFilter" class="form-label">Nilai Tugas <i class="fas fa-greater-than-equal"></i></label>
                        <input type="text" class="form-control" id="tugasFilter" name="tugas" value="<?php echo $filters['tugas']; ?>">
                    </div>

                    <div class="mb-3 custom-form">
                        <label for="utsFilter" class="form-label">Nilai UTS <i class="fas fa-greater-than-equal"></i></label>
                        <input type="text" class="form-control" id="utsFilter" name="uts" value="<?php echo $filters['uts']; ?>">
                    </div>

                    <div class="mb-3 custom-form">
                        <label for="uasFilter" class="form-label">Nilai UAS <i class="fas fa-greater-than-equal"></i></label>
                        <input type="text" class="form-control" id="uasFilter" name="uas" value="<?php echo $filters['uas']; ?>">
                    </div>

                    <div class="mb-3 custom-form">
                        <label for="tugasAkhirFilter" class="form-label">Nilai Praktikum <i class="fas fa-greater-than-equal"></i></label>
                        <input type="text" class="form-control" id="tugasAkhirFilter" name="tugas_akhir" value="<?php echo $filters['tugas_akhir']; ?>">
                    </div>

                    <div class="mb-3 custom-form">
                        <label for="ipkFilter" class="form-label">Nilai Akhir <i class="fas fa-greater-than-equal"></i></label>
                        <input type="text" class="form-control" id="ipkFilter" name="ipk" value="<?php echo $filters['ipk']; ?>">
                    </div>
                    
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="aboveAverageFilter" name="above_average" <?php echo ($filters['above_average'] === '1') ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="aboveAverageFilter">Nilai Akhir di atas rata-rata</label>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="belowAverageFilter" name="below_average" <?php echo ($filters['below_average'] === '1') ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="belowAverageFilter">Nilai Akhir di bawah rata-rata</label>
                    </div>

                    <div class="mb-4">
                        <label for="predikatFilter" class="form-label">Predikat</label>
                        <select class="form-select" id="predikatFilter" name="predikat">
                            <option value="">Semua</option>
                            <option value="A" <?php echo ($filters['predikat'] === 'A') ? 'selected' : ''; ?>>A</option>
                            <option value="A-" <?php echo ($filters['predikat'] === 'A-') ? 'selected' : ''; ?>>A-</option>
                            <option value="B+" <?php echo ($filters['predikat'] === 'B+') ? 'selected' : ''; ?>>B+</option>
                            <option value="B" <?php echo ($filters['predikat'] === 'B') ? 'selected' : ''; ?>>B</option>
                            <option value="B-" <?php echo ($filters['predikat'] === 'B-') ? 'selected' : ''; ?>>B-</option>
                            <option value="C+" <?php echo ($filters['predikat'] === 'C+') ? 'selected' : ''; ?>>C+</option>
                            <option value="C" <?php echo ($filters['predikat'] === 'C') ? 'selected' : ''; ?>>C</option>
                        </select>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center mb-3">

                    <div class="d-flex">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal">Batal</button>
                    </div>

                    <button type="button" class="btn btn-outline-secondary" onclick="resetFilter()">Reset Filter</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
