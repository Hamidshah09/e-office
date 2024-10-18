SELECT l.id, l.letter_no, l.subject, a.addressee_name, ub.name, t.sent_on, ts.tracking_status as sender from trackings as t 
join addressees as a
	on t.marked_to = a.id
join letters as l
	on l.id = t.letter_id
LEFT JOIN users as ut
	on ut.id = t.sent_to
LEFT JOIN users as ub
	on ub.id = t.send_by
join tracking_statuses as ts
	on ts.id = t.tracking_status_id
where (t.sent_to = 2 and t.tracking_status_id =2) and 
t.letter_id not in (select letter_id from trackings where send_by = 2);