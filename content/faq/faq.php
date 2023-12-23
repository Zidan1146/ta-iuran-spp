<p class="judul_profile2">FAQ</p>  
<div class="notif-container">
  <?php
    $faq = [
      [
        "question" => 'Apa itu web iuran spp?',
        "answer" => 'Web iuran spp adalah platform online yang digunakan untuk mengumpulkan iuran Sumbangan Pembinaan Pendidikan (SPP) secara digital.'
      ],
      [
        "question" => 'Siapa yang dapat menggunakan web iuran spp?',
        "answer" => 'Semua orang, baik itu wali murid, guru, maupun orang tua dapat menggunakan web iuran spp untuk melakukan pembayaran iuran spp secara online.'
      ],
      [
        "question" => 'Apa manfaat menggunakan web iuran spp?',
        "answer" => 'Dengan menggunakan web iuran spp, Anda dapat melakukan pembayaran iuran SPP dengan mudah, cepat, dan aman. Selain itu, Anda juga dapat memperoleh data mengenai iuran SPP yang sudah dibayarkan dan status pembayaran untuk membantu mengelola keuangan.'
      ],
      [
        "question" => 'Bagaimana cara menggunakan web iuran spp?',
        "answer" => 'Pertama-tama, Anda perlu mendaftarkan akun di web iuran spp. Setelah itu, pilih jumlah iuran SPP yang ingin dibayarkan dan pilih metode pembayaran yang diinginkan.'
      ],
      [
        "question" => 'Apa saja fitur yang tersedia di Web Iuran SPP?',
        "answer" => 'Berikut adalah fitur yang tersedia di Web Iuran SPP :',
        "point" => [
          'Pembayaran Iuran SPP secara online',
          'Riwayat pembayaran Iuran SPP',
          'Rekapan pembayaran Iuran SPP'
        ]
      ]
    ];
    $count = count($faq);
    for ($i = 0; $i < $count; $i++) {
  ?>
    <div class="notif-child">
      <div class="fieldset_notif">
        <ol start="<?= $i + 1 ?>">
          <li>
            <h3><?= $faq[$i]['question'] ?></h3>
            <p><?= $faq[$i]['answer'] ?></p>
            <?php
              if(isset($faq[$i]['point'])) {
            ?>
            <ul>
                <?php
                  foreach($faq[$i]['point'] as $value) {
                    echo "<li>".$value."</li>";
                  }
                ?>
            </ul>
            <?php
              }
            ?>
          </li>
        </ol>
      </div>
    </div>
  <?php
    }
  ?>
</div>