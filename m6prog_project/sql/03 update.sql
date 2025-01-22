update `imageupload` set uploadDateTime = DATE_ADD(uploadDateTime, INTERVAL -31 DAY);



UPDATE PhotoMetadata 
SET upload_date = DATE_ADD(upload_date, INTERVAL -365 DAY);
