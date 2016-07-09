<form action="" method="post">
    <div class="row">
        <div class="col s12">
            <div class="card-panel">
                <span class="orange-text text-darken-2"><i class="material-icons left">warning</i> Des changements sur cette page peuvent nuir au bon fonctionnement du site. Veuillez vérifier l'exactitude des informations avant de valider</span>
            </div>
        </div>

        <div class="col s12">
            <h5>Configuration</h5>
        </div>
        <div class="col s12 input-field">
            <input id="BASE_URL" name="BASE_URL" type="text" value="<?php echo htmlentities(isset($_POST['BASE_URL'])?$_POST['BASE_URL']:BASE_URL);?>">
            <label for="BASE_URL">BASE_URL</label>
        </div>
        <div class="col s12 input-field">
            <input id="BASE_URL_ADMIN" name="BASE_URL_ADMIN" type="text" value="<?php echo htmlentities(isset($_POST['BASE_URL_ADMIN'])?$_POST['BASE_URL_ADMIN']:BASE_URL_ADMIN);?>">
            <label for="BASE_URL_ADMIN">BASE_URL_ADMIN</label>
        </div>
        <div class="col s12 input-field">
            <input id="APP_TITLE" name="APP_TITLE" type="text" value="<?php echo htmlentities(isset($_POST['APP_TITLE'])?$_POST['APP_TITLE']:APP_TITLE);?>">
            <label for="APP_TITLE">APP_TITLE</label>
        </div>
        <div class="col s12 input-field">
            <input id="APP_VERSION" name="APP_VERSION" type="text" value="<?php echo htmlentities(isset($_POST['APP_VERSION'])?$_POST['APP_VERSION']:APP_VERSION);?>">
            <label for="APP_VERSION">APP_VERSION</label>
        </div>
        <div class="col s12 input-field">
            <input id="LOG_DIRECTORY" name="LOG_DIRECTORY" type="text" value="<?php echo htmlentities(isset($_POST['LOG_DIRECTORY'])?$_POST['LOG_DIRECTORY']:LOG_DIRECTORY);?>">
            <label for="LOG_DIRECTORY">LOG_DIRECTORY</label>
        </div>
        <div class="col s12 input-field">
            <input id="WEBMASTER_ADDRESS" name="WEBMASTER_ADDRESS" type="text" value="<?php echo htmlentities(isset($_POST['WEBMASTER_ADDRESS'])?$_POST['WEBMASTER_ADDRESS']:WEBMASTER_ADDRESS);?>">
            <label for="WEBMASTER_ADDRESS">WEBMASTER_ADDRESS</label>
        </div>
        <div class="col s12 input-field">
            <input id="TWITTER_ID" name="TWITTER_ID" type="text" value="<?php echo htmlentities(isset($_POST['TWITTER_ID'])?$_POST['TWITTER_ID']:TWITTER_ID);?>">
            <label for="TWITTER_ID">TWITTER_ID</label>
        </div>

        <div class="col s12">
            <h5>Base de données</h5>
        </div>
        <div class="col s12 input-field">
            <input id="USING_A_DB" name="USING_A_DB" type="text" value="<?php echo htmlentities(isset($_POST['USING_A_DB'])?$_POST['USING_A_DB']:USING_A_DB);?>" readonly>
            <label for="USING_A_DB">USING_A_DB</label>
        </div>
        <div class="col s12 input-field">
            <input id="DBNAME" name="DBNAME" type="text" value="<?php echo htmlentities(isset($_POST['DBNAME'])?$_POST['DBNAME']:DBNAME);?>">
            <label for="DBNAME">DBNAME</label>
        </div>
        <div class="col s12 input-field">
            <input id="DBHOST" name="DBHOST" type="text" value="<?php echo htmlentities(isset($_POST['DBHOST'])?$_POST['DBHOST']:DBHOST);?>">
            <label for="DBHOST">DBHOST</label>
        </div>
        <div class="col s12 input-field">
            <input id="DBTYPE" name="DBTYPE" type="text" value="<?php echo htmlentities(isset($_POST['DBTYPE'])?$_POST['DBTYPE']:DBTYPE);?>">
            <label for="DBTYPE">DBTYPE</label>
        </div>
        <div class="col s12 input-field">
            <input id="DBPORT" name="DBPORT" type="number" value="<?php echo htmlentities(isset($_POST['DBPORT'])?$_POST['DBPORT']:DBPORT);?>">
            <label for="DBPORT">DBPORT</label>
        </div>
        <div class="col s12 input-field">
            <input id="DBUSER" name="DBUSER" type="text" value="<?php echo htmlentities(isset($_POST['DBUSER'])?$_POST['DBUSER']:DBUSER);?>">
            <label for="DBUSER">DBUSER</label>
        </div>
        <div class="col s12 input-field">
            <input id="DBPASSWORD" name="DBPASSWORD" type="password" value="<?php echo htmlentities(isset($_POST['DBPASSWORD'])?$_POST['DBPASSWORD']:DBPASSWORD);?>">
            <label for="DBPASSWORD">DBPASSWORD</label>
        </div>

        <div class="col s12">
            <h5>Email</h5>
        </div>
        <div class="col s12 input-field">
            <input id="EMAIL_FROM" name="EMAIL_FROM" type="email" value="<?php echo htmlentities(isset($_POST['EMAIL_FROM'])?$_POST['EMAIL_FROM']:EMAIL_FROM);?>">
            <label for="EMAIL_FROM">EMAIL_FROM</label>
        </div>
        <div class="col s12 input-field">
            <input id="EMAIL_FROM_NAME" name="EMAIL_FROM_NAME" type="text" value="<?php echo htmlentities(isset($_POST['EMAIL_FROM_NAME'])?$_POST['EMAIL_FROM_NAME']:EMAIL_FROM_NAME);?>">
            <label for="EMAIL_FROM_NAME">EMAIL_FROM_NAME</label>
        </div>
        <div class="col s12 input-field">
            <input id="EMAIL_REPLY" name="EMAIL_REPLY" type="email" value="<?php echo htmlentities(isset($_POST['EMAIL_REPLY'])?$_POST['EMAIL_REPLY']:EMAIL_REPLY);?>">
            <label for="EMAIL_REPLY">EMAIL_REPLY</label>
        </div>
        <div class="col s12 input-field">
            <input id="EMAIL_REPLY_NAME" name="EMAIL_REPLY_NAME" type="text" value="<?php echo htmlentities(isset($_POST['EMAIL_REPLY_NAME'])?$_POST['EMAIL_REPLY_NAME']:EMAIL_REPLY_NAME);?>">
            <label for="EMAIL_REPLY_NAME">EMAIL_REPLY_NAME</label>
        </div>
        <div class="col s12 input-field">
            <input id="EMAIL_SMTP_HOST" name="EMAIL_SMTP_HOST" type="text" value="<?php echo htmlentities(isset($_POST['EMAIL_SMTP_HOST'])?$_POST['EMAIL_SMTP_HOST']:EMAIL_SMTP_HOST);?>">
            <label for="EMAIL_SMTP_HOST">EMAIL_SMTP_HOST</label>
        </div>
        <div class="col s12 input-field">
            <input id="EMAIL_SMTP_ADDRESS" name="EMAIL_SMTP_ADDRESS" type="text" value="<?php echo htmlentities(isset($_POST['EMAIL_SMTP_ADDRESS'])?$_POST['EMAIL_SMTP_ADDRESS']:EMAIL_SMTP_ADDRESS);?>">
            <label for="EMAIL_SMTP_ADDRESS">EMAIL_SMTP_ADDRESS</label>
        </div>
        <div class="col s12 input-field">
            <input id="EMAIL_SMTP_PWD" name="EMAIL_SMTP_PWD" type="password" value="<?php echo htmlentities(isset($_POST['EMAIL_SMTP_PWD'])?$_POST['EMAIL_SMTP_PWD']:EMAIL_SMTP_PWD);?>">
            <label for="EMAIL_SMTP_PWD">EMAIL_SMTP_PWD</label>
        </div>
        <div class="col s12 input-field">
            <input id="EMAIL_SMTP_PORT" name="EMAIL_SMTP_PORT" type="number" value="<?php echo htmlentities(isset($_POST['EMAIL_SMTP_PORT'])?$_POST['EMAIL_SMTP_PORT']:EMAIL_SMTP_PORT);?>">
            <label for="EMAIL_SMTP_PORT">EMAIL_SMTP_PORT</label>
        </div>
    </div>
    <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
        <button type="submit" class="btn-floating btn-large BUTTON_BACKGROUND-COLOR">
            <i class="large material-icons">check</i>
        </button>
    </div>	
</form>