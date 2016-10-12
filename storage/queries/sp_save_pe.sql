CREATE PROCEDURE IF NOT EXISTS SP_SavePE(
        IN psy VARCHAR(100), 
        IN psem VARCHAR(100), 
        IN pSN BIGINT,
        IN pskin VARCHAR(255),
        IN phead_scalp VARCHAR(255),
        IN peyes_external VARCHAR(255),
        IN ppupils_opthatmoscopic VARCHAR(255),
        IN pears VARCHAR(255),
        IN pnose_sinuses VARCHAR(255),
        IN pmouth_throat VARCHAR(255),
        IN pneck_ln_thyroid VARCHAR(255),
        IN pchest_breast_axilla VARCHAR(255),
        IN plungs VARCHAR(255),
        IN pheart VARCHAR(255),
        IN pabdomen VARCHAR(255),
        IN pback VARCHAR(255),
        IN panus_rectum VARCHAR(255),
        IN pgu_system VARCHAR(255),
        IN preflexes VARCHAR(255),
        IN pextremities VARCHAR(255),
        IN plicense_no INT,
        IN paction_by_id INT
    )
    BEGIN
    
    DECLARE existing_record_count INT;

    START TRANSACTION;

    SELECT COUNT(*) INTO existing_record_count 
        FROM `tbl_physicalexam`
        WHERE SY = psy
        AND sem = psem
        AND SN = pSN;

    IF(existing_record_count < 1) THEN
        INSERT INTO `tbl_physicalexam` (SY, sem, SN, 
        skin,
        head_scalp ,
        eyes_external ,
        pupils_opthatmoscopic ,
        ears ,
        nose_sinuses ,
        mouth_throat ,
        neck_ln_thyroid ,
        chest_breast_axilla ,
        lungs ,
        heart ,
        abdomen ,
        back ,
        anus_rectum ,
        gu_system ,
        reflexes ,
        extremities, 
        license_no)
            VALUES (psy, psem, pSN, 
            pskin,
            phead_scalp ,
            peyes_external ,
            ppupils_opthatmoscopic ,
            pears ,
            pnose_sinuses ,
            pmouth_throat ,
            pneck_ln_thyroid ,
            pchest_breast_axilla ,
            plungs ,
            pheart ,
            pabdomen ,
            pback ,
            panus_rectum ,
            pgu_system ,
            preflexes ,
            pextremities, 
            plicense_no);

        INSERT INTO `tbl_activitylog` (logdesc, logdate, loguser)
            VALUES (CONCAT('Created a new physical exam record for student : ', pSN, ', school year: ', psy, ' ', psem, ' semester'), CURRENT_TIMESTAMP, paction_by_id);

    ELSE        
        UPDATE `tbl_physicalexam` 
            SET 
                SY = psy, 
                sem = psem,
                SN = pSN,
                skin = pskin,
                head_scalp = phead_scalp,
                eyes_external = peyes_external,
                pupils_opthatmoscopic = ppupils_opthatmoscopic,
                ears = pears,
                nose_sinuses = pnose_sinuses,
                mouth_throat = pmouth_throat,
                neck_ln_thyroid = pneck_ln_thyroid,
                chest_breast_axilla = pchest_breast_axilla,
                lungs = plungs,
                heart = pheart,
                abdomen = pabdomen,
                back = pback,
                anus_rectum = panus_rectum,
                gu_system = pgu_system,
                reflexes = preflexes,
                extremities = pextremities, 
                license_no = plicense_no               
            WHERE SY = psy
            AND sem = psem
            AND SN = pSN;

        INSERT INTO `tbl_activitylog` (logdesc, logdate, loguser)
            VALUES (CONCAT('Updated new physical exam record for student : ', pSN, ', school year: ', psy, ' ', psem, ' semester'), CURRENT_TIMESTAMP, paction_by_id);
    END IF;

    COMMIT;
END