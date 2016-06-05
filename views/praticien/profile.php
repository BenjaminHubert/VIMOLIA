<h3>Détail du praticien</h3>
<div class="row">
    <div class="col s3">
        <img src="<?php echo ($doctor['url_avatar'] == NULL)?BASE_URL.'img/avatar/user.png':$doctor['url_avatar'];?>" class="responsive-img materialboxed" alt="">
    </div>
    <div class="col s9">
        <div class="row">
            <div class="col s6">
                <p id="name" class="bold"><?php echo $doctor['first_name'].' '.$doctor['last_name'];?></p>
                <p>Spécialiste en: <span id="skills"><?php echo implode(', ', $doctor['skills']);?></span></p>
                <br><br><br>
            </div>
            <div class="col s6 card">
                <p id="contact-title">Contact</p>
                <div>
                    <span class="bold">Adresse:</span>
                    <ul>
                        <li><?php echo $doctor['address']; ?></li>
                        <li><?php echo $doctor['city'].' '.$doctor['postal_code']; ?></li>
                    </ul>
                </div>
                <p><span class="bold">Tél:</span> <?php echo $doctor['phone']|$doctor['mobile'];?></p>
                <p><span class="bold">Mail:</span> <a target="_blank" href="mailto:<?php echo $doctor['email'];?>"><?php echo $doctor['email'];?></a></p>
            </div>
            <div class="col s12">
                <p id="presentation-title">Présentation:</p>
                <div id="presentation">
                    <p><?php echo $doctor['presentation'];?></p>
                </div>
            </div>
            <div class="col s6">
                <p id="general-info-title">Infos VIMOLIA</p>
                <ul>
                    <li>Inscription le <?php echo date('d-m-Y', strtotime($doctor['date_inscription']));?></li>
                </ul>
            </div>
            <div class="col s6">
                <p id="diplomes-title">Diplômes: </p>
                <ul>
                    <li><?php echo $doctor['diploma'];?></li>
                </ul>
            </div>
        </div>
    </div>
</div>