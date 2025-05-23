-- https://dbdiagram.io/home -- 


-- Create users table
CREATE TABLE users IF NOT EXISTS(
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create events table
CREATE TABLE events IF NOT EXISTS (
    event_id INT AUTO_INCREMENT PRIMARY KEY,
    creator_id INT NOT NULL,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    start_datetime DATETIME NOT NULL,
    end_datetime DATETIME NOT NULL,
    location VARCHAR(100),
    FOREIGN KEY (creator_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create tickets table
CREATE TABLE tickets IF NOT EXISTS (
    ticket_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    event_id INT NOT NULL,
    UNIQUE KEY (user_id, event_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (event_id) REFERENCES events(event_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Set Indexes
ALTER TABLE events AUTO_INCREMENT = 1;
ALTER TABLE users AUTO_INCREMENT = 1;
ALTER TABLE tickets AUTO_INCREMENT = 1;

-- Inser users
INSERT INTO users (username, password)
VALUES ('dev', 'phrase');

INSERT INTO users (username, password)
VALUES ('dev2', 'phrase2');

-- Insert events
INSERT INTO events (
    creator_id,
    title,
    description,
    start_datetime,
    end_datetime,
    location
) VALUES (
    1,
    'Hackathon 2025',
    'A 48-hour coding challenge for developers of all skill levels. Join to innovate and compete!',
    '2025-06-15 09:00:00',
    '2025-06-17 09:00:00',
    'Innovation Hub, Tech City'
);

INSERT INTO events (
    creator_id,
    title,
    description,
    start_datetime,
    end_datetime,
    location
) VALUES (
    2,
    'AI & Robotics Expo',
    'An exhibition showcasing the latest in AI and robotics, including demos, panels, and networking sessions.',
    '2025-07-10 10:00:00',
    '2025-07-10 18:00:00',
    'Tech Convention Center, Silicon Valley'
);