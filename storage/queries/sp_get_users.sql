CREATE PROCEDURE IF NOT EXISTS SP_GetUsers()
    BEGIN
    SELECT * FROM tbl_useraccount 
    LEFT JOIN tbl_usertype 
        ON usertype = typeid;
END