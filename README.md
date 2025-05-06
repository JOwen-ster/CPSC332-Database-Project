# CPSC332-Database-Project

USERS (maybe add profile icon using links to images)
* Every user has an id, username, password, datetime 
* Every user can create multiple events
* Every user can delete their own events (every attendee has that event deleted from their list)
* Every user can update their own events (title, description, date, time, location, max_members)
* Every user can remove users from an event they created
* Every user can signup to multiple events
* Every user can create a ticket for an event
* Every user can view tickets they created and for their own events
* Every user can close tickets they created and for their own eventts


EVENTS
* Every event has a id, creator_id (user_id foreign key), title, description, start_time, location, attendees (JSON), end_time


TICKETS
when you join an event you get a ticket if you leave you lose it and a ticket points to and event id

example is select * from tickets where event_id = 1 and user_id = 1 then render those events