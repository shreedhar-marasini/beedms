/*

this is for user activity view


Create VIEW v_user_activity as SELECT id as document_id, 'incoming' as document_type , uploaded_by_user_id as user_id ,'incoming'as activity_type , created_at as created_at, NULL as issued_by_user_id, NULL as signed_by_user_id, deleted_at as deleted_date FROM dms_incoming_documents UNION

SELECT id as document_id, 'outgoing' as document_type , created_by_user_id as user_id, 'outgoing'as activity_type , created_at as created_at, issued_by as issued_by_user_id, signature_user_id as signed_by_user_id, deleted_at as deleted_date FROM dms_outgoing_documents UNION

SELECT id as document_id, 'digitized' as document_type , uploaded_by_user_id as user_id, 'digitized'as activity_type , created_at as created_at, NULL as issued_by_user_id, NULL as signed_by_user_id , deleted_at as deleted_date FROM dms_digitized_documents UNION

SELECT email_logs_document_id as document_id, email_logs_document_type as document_type , sender_user_id as user_id ,'email'as activity_type , created_at as created_at, NULL as issued_by_user_id, NULL as signed_by_user_id ,NULL as deleted_date FROM dms_email_logs UNION

SELECT documents_id as document_id, document_comments_type as document_type , commented_by_user_id as user_id ,'comments'as activity_type , created_at as created_at, NULL as issued_by_user_id, NULL as signed_by_user_id, NULL as deleted_date FROM dms_document_comments UNION

SELECT tracks_document_id as document_id, tracks_document_type as document_type , document_access_user_id as user_id ,'tracks'as activity_type , created_at as created_at, NULL as issued_by_user_id, NULL as signed_by_user_id, NULL as deleted_date FROM dms_document_tracks UNION

SELECT document_id as document_id, document_type as document_type , reminder_user_id as user_id ,'reminder'as activity_type , created_at as created_at, NULL as issued_by_user_id, NULL as signed_by_user_id, NULL as deleted_date FROM dms_reminders


*/
/*



this is for institution view


CREATE VIEW v_institution_timeline AS SELECT id AS document_id,sender_institution_id as institution_id ,created_at AS created_date,deleted_at as deleted_date,'incoming' AS documentType,'incoming' AS timelineType FROM dms_incoming_documents UNION

SELECT id AS document_id,institution_id as institution_id, created_at AS created_date,deleted_at as deleted_date,'outgoing' AS documentType,'outgoing' AS timelineType FROM dms_outgoing_documents UNION


SELECT id AS document_id,related_institution_id as institution_id, created_at AS created_date,deleted_at as deleted_date,'digitized' AS documentType,'digitized' AS timelineType FROM dms_digitized_documents UNION

SELECT email_logs_document_id AS document_id,institution_id as institution_id, created_at AS created_date,NULL as deleted_date,email_logs_document_type AS documentType,'email' AS timelineType FROM dms_email_logs
*/
/*

this is for document track view


CREATE VIEW v_document_timeline AS SELECT id AS track_id,tracks_document_id AS document_id, tracks_action_date AS action_date,tracks_document_type AS document_type,'tracking' AS timelineType,created_at as timeline_created_at FROM dms_document_tracks UNION SELECT id AS track_id,email_logs_document_id AS document_id, email_logs_sent_date AS action_date,email_logs_document_type AS document_type, 'email_log'AS timelineType, created_at as timeline_created_at FROM dms_email_logs


*/