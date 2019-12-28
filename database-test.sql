select d.doctor_name, a.patient_name, concat(s.date,' ',s.time) as slot_date_time from appointments a inner join doctors d on
a.doctor_id = d.id inner join slots s on 
a.slot_id = s.id where MONTH(s.date) = 10 AND a.deleted_at is null ORDER BY s.time ASC
;

select doctor_name, count(doctor_id) as appointment_count from appointments a inner join doctors d on
a.doctor_id = d.id
where doctor_id in (select doctor_id from 
    (select doctor_id, count(doctor_id) as appointment_count
     from appointments where deleted_at is null
     group by doctor_id
     having appointment_count = (select max(count) from (select doctor_id, count(doctor_id) as count from appointments where deleted_at is null group by doctor_id) x)
    ) y ) AND deleted_at is null group by doctor_id;

    
select d.doctor_name, sum(duration) as total_duration from appointments a inner join doctors d on
a.doctor_id = d.id inner join slots s on 
a.slot_id = s.id where a.deleted_at is null group by doctor_id ORDER BY total_duration DESC;