CREATE PROCEDURE IF NOT EXISTS SP_PEDatatable(
        IN psearch VARCHAR(100), 
        IN sortColumn VARCHAR(100), 
        IN sortOrder VARCHAR(100), 
        IN poffset INT, 
        IN pfetch_count INT
    )
    BEGIN    

    IF (NOT psearch IS NULL AND psearch != '') THEN
        SET @quotedPSearch = QUOTE(CONCAT('%', psearch, '%'));
        SET @whereClause = CONCAT(
            ' WHERE username LIKE ', @quotedPSearch,
            ' OR complete_name LIKE ', @quotedPSearch
         );
    ELSE
        SET @whereClause = '';
    END IF;    

    IF (NOT sortColumn IS NULL AND sortColumn != '') THEN
        SET @orderClause = CONCAT(' ORDER BY ', sortColumn, ' ', sortOrder);
    ELSE
        SET @orderClause ='';
    END IF;

    SET @limitClause = CONCAT(' LIMIT ', poffset, ', ', pfetch_count);
    SET @stmt = CONCAT('SELECT * FROM `tbl_physicalexam` ', @whereClause, @orderClause, @limitClause, ';');

    PREPARE stmt FROM @stmt;

    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;

END