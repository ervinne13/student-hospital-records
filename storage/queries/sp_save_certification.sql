CREATE PROCEDURE IF NOT EXISTS SP_SaveCertifiation(
        IN psy VARCHAR(100), 
        IN psem VARCHAR(100), 
        IN pSN BIGINT,
        IN psummary TEXT,
        IN pskin_disease TINYINT(1),
        IN panemia TINYINT(1),
        IN ppoorvision TINYINT(1),
        IN pintestinal_paratism TINYINT(1),
        IN ppulmoary_tubercolosis TINYINT(1),
        IN phypertension TINYINT(1),
        IN purinary_tract_infection TINYINT(1),
        IN pothers TEXT,
        IN ptreatment_optional TEXT,
        IN pno_treatment VARCHAR(45),       
        IN pmd_examineer_id INT,
        IN pdateexamined TIMESTAMP,
        IN ppaction_by_id INT
    )
    BEGIN
    
    DECLARE existing_record_count INT;

    START TRANSACTION;

    SELECT COUNT(*) INTO existing_record_count 
        FROM `tbl_certification`
        WHERE SY = psy
        AND sem = psem
        AND SN = pSN;

    IF(existing_record_count < 1) THEN
        INSERT INTO `tbl_certification` (SY, sem, SN, 
            summary,
            skin_disease,
            anemia,
            poorvision,
            intestinal_paratism,
            pulmoary_tubercolosis,
            hypertension,
            urinary_tract_infection,
            others,
            treatment_optional,
            no_treatment,
            md_examineer_id,
            dateexamined)
            VALUES (psy, psem, pSN, 
                psummary,
                pskin_disease,
                panemia,
                ppoorvision,
                pintestinal_paratism,
                ppulmoary_tubercolosis,
                phypertension,
                purinary_tract_infection,
                pothers,
                ptreatment_optional,
                pno_treatment,
                pmd_examineer_id,
                CURRENT_TIMESTAMP);

        INSERT INTO `tbl_activitylog` (logdesc, logdate, loguser)
            VALUES (CONCAT('Created a new certification record for student : ', pSN, ', school year: ', psy, ' ', psem, ' semester'), CURRENT_TIMESTAMP, paction_by_id);

    ELSE        
        UPDATE `tbl_certification` 
            SET 
                SY = psy, 
                sem = psem,
                SN = pSN,
                summary=psummary,
                skin_disease=pskin_disease,
                anemia=panemia,
                poorvision=ppoorvision,
                intestinal_paratism=pintestinal_paratism,
                pulmoary_tubercolosis=ppulmoary_tubercolosis,
                hypertension=phypertension,
                urinary_tract_infection=purinary_tract_infection,
                others=pothers,
                treatment_optional=ptreatment_optional,
                no_treatment=pno_treatment,
                md_examineer_id=pmd_examineer_id,
                dateexamined=CURRENT_TIMESTAMP
            WHERE SY = psy
            AND sem = psem
            AND SN = pSN;

        INSERT INTO `tbl_activitylog` (logdesc, logdate, loguser)
            VALUES (CONCAT('Updated new certification record for student : ', pSN, ', school year: ', psy, ' ', psem, ' semester'), CURRENT_TIMESTAMP, paction_by_id);
    END IF;

    COMMIT;
END