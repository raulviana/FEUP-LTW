
PRAGMA foreign_keys = ON;


DROP TABLE IF EXISTS posts;
DROP TABLE IF EXISTS pets;
DROP TABLE IF EXISTS tags;
DROP TABLE IF EXISTS pets_tags;
DROP TABLE IF EXISTS users_posts;
DROP TABLE IF EXISTS pets_images;
DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS photo;
DROP TABLE IF EXISTS wishlist;
DROP TABLE IF EXISTS wish_pets;
DROP TABLE IF EXISTS proposal;
DROP TABLE IF EXISTS proposal_photos;
DROP TABLE IF EXISTS proposal_posts;

CREATE TABLE user (
    id INTEGER PRIMARY KEY,
    username VARCHAR NOT NULL,
    email VARCHAR NOT NULL UNIQUE,
    'password' VARCHAR NOT NULL,
    photo VARCHAR DEFAULT NULL
);

CREATE TABLE tags (
    id INTEGER PRIMARY KEY,
    'name' VARCHAR NOT NULL
);

CREATE TABLE pets (
    id INTEGER PRIMARY KEY,
    'name' VARCHAR NOT NULL,
    'description' NOT NULL,
    age INTEGER,
    adopted INTEGER NOT NULL DEFAULT 0, 
    'location' VARCHAR NOT NULL,
    'date' DateTime NOT NULL,
    size VARCHAR CHECK(size IN ('S', 'M', 'L')) NOT NULL DEFAULT 'M',
    'owner' INTEGER CHECK('owner' <> poster),
    poster INTEGER,
    pet_tag INTEGER,
    FOREIGN KEY('owner') REFERENCES user(id) ON UPDATE CASCADE ON DELETE SET DEFAULT,
    FOREIGN KEY(poster) REFERENCES user(id) ON UPDATE CASCADE ON DELETE SET NULL,
    FOREIGN KEY(pet_tag) REFERENCES tags(id)
);

CREATE TABLE photo (
    id INTEGER PRIMARY KEY, 
    'path' VARCHAR NOT NULL,
    pet_id INTEGER NOT NULL, 
    FOREIGN KEY (pet_id) REFERENCES pets(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE posts (
    id INTEGER PRIMARY KEY,
    'text' VARCHAR NOT NULL,
    poster INTEGER NOT NULL,
    pet INTEGER NOT NULL,
    'date' DateTime NOT NULL,
    parent_id INTEGER DEFAULT NULL,
    FOREIGN KEY(poster) REFERENCES user(id) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY(pet) REFERENCES pets(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE wishlist (
    id INTEGER PRIMARY KEY,
    'name' VARCHAR NOT NULL,
    'user_id' INTEGER NOT NULL,
    FOREIGN KEY('user_id') REFERENCES user(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE wish_pets (
    wish_id INTEGER NOT NULL,
    pet_id INTEGER NOT NULL,
    FOREIGN KEY(wish_id) REFERENCES wishlist(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(pet_id) REFERENCES pets(id) ON DELETE SET NULL ON UPDATE CASCADE,
    PRIMARY KEY (wish_id, pet_id)
);

CREATE TABLE proposal (
    id INTEGER PRIMARY KEY,
    content VARCHAR NOT NULL,
    'date' DateTime NOT NULL,
    'location' VARCHAR,
    'active' INTEGER NOT NULL DEFAULT 1,
    proponent_id INTEGER NOT NULL,
    pet_id INTEGER NOT NULL,
    FOREIGN KEY(proponent_id) REFERENCES user(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(pet_id) REFERENCES pets(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE proposal_photo (
    id INTEGER PRIMARY KEY,
    'path' VARCHAR NOT NULL,
    proposal_id INTEGER NOT NULL,
    FOREIGN KEY(proposal_id) REFERENCES proposal(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE proposal_posts (
    id INTEGER PRIMARY KEY,
    content VARCHAR NOT NULL,
    'date' DateTime NOT NULL,
    user_id INTEGER,
    parent_id INTEGER DEFAULT NULL,
    proposal_id INTEGER NOT NULL,
    FOREIGN KEY(user_id) REFERENCES user(id) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY(proposal_id) REFERENCES proposal(id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- CREATE TRIGGER IF NOT EXISTS update_states 
--     AFTER UPDATE ON proposal
--     WHEN active = FALSE
--     BEGIN
--         UPDATE pets
--         SET active = FALSE
--         WHERE proposal.pet_id = pets.id;
--     END;


INSERT INTO user VALUES(NULL,'jhon_vegan', 'jhon_doe@example.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', NULL);
INSERT INTO user VALUES(NULL, 'jane', 'jane_31@example.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', NULL);
INSERT INTO user VALUES(NULL, 'Karen', 'karen_95@example.com','a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', NULL);

INSERT INTO tags VALUES(NULL, 'dog');
INSERT INTO tags VALUES(NULL, 'cat');
INSERT INTO tags VALUES(NULL, 'bird');
INSERT INTO tags VALUES(NULL, 'rabbit');
INSERT INTO tags VALUES(NULL, 'hamster');
INSERT INTO tags VALUES(NULL, 'horse');
INSERT INTO tags VALUES(NULL, 'turtle');
INSERT INTO tags VALUES(NULL, 'pig');

INSERT INTO pets VALUES(NULL, 'kitty', 'very beautiful cat', 3, 0, 'porto','2020-11-04 13:02:02','S',NULL, 1, 2);
INSERT INTO photo VALUES(NULL, 'cat.jpg', 1);
INSERT INTO pets VALUES(NULL, 'Zafir', 'Gostariamos de conseguir mudar o olhar do Zafir mas ainda não conseguimos. A vida que teve até chegar ao nosso abrigo foi dura. É um menino doce e tranquilo mas ainda tem a dor que o acompanhou durante bastante tempo. Precisa de um lar e muito amor para que os seus olhos voltem a brilhar e possam iluminar toda a sua vida.'
                            , 2, 0, 'Braga', '2020-11-12 23:23:33', 'S', NULL, 1, 1);
INSERT INTO photo VALUES(NULL, 'cao1.jpg', 2);
INSERT INTO pets VALUES(NULL, 'Espiga', 'O Espiga é um gatinho especial... Um gatinho que adora dar turras e dormir no sofá. Um gatinho simpático e carente.'
                            , 1, 0, 'Leça', '2020-10-23 10:10:45', 'S', NULL, 1, 2);
INSERT INTO photo Values(NULL, 'gato2.jpg', 3);
INSERT into pets VALUES(NULL, 'Poldra', 'O Poldra precisa de um lar. Foi encontrado num descampado, cheio de fome e com frio. Adora correr e saltar vedações.'
                            , 6, 0, 'Beja', '2020-09-09 05:23:43', 'M', NULL, 1, 6);
INSERT INTO photo VALUES(NULL, 'cavalo.jpg', 4);
INSERT INTO pets VALUES(NULL, 'Babe', 'Este porquinho adora crianças, é muito limpinho e gosta muito de tomar banho. Precisa de uma casa nova.'
                            , 1, 0, 'Fão', '2020-09-07 10:23:44', 'S', NULL, 1, 8);
INSERT INTO photo VALUES(NULL, 'porco.jpg', 5);
INSERT INTO photo VALUES(NULL, 'pig2.jpg', 5);
INSERT INTO photo VALUES(NULL, 'pig3.jpg', 5);
INSERT into pets VALUES(NULL, 'Alberto', 'O Alberto sabe imitar o telefone e outras coisas. Assobia o hino nacional.'
                            , 3, 1, 'Murtosa', '2020-10-20 09:12:05', 'M', 2, 2, 3);
INSERT INTO photo VALUES(NULL, 'arara.jpg', 6);


INSERT INTO posts VALUES(NULL, 'nice cat needs new home', 1, 1, DateTime('now'), NULL);
INSERT INTO posts VALUES(NULL, 'does kitty likes to go outside?', 2, 1, DateTime('now'), 1);
INSERT INTO posts VALUES(NULL, 'O Zafir gosta de crianças?', 2, 2, DateTime('now'), NULL);
INSERT INTO posts VALUES(NULL, 'Não tenho conhecimento de o Zafir ter contacto com nenhuma criança, mas é muito simpático.', 1, 2, DateTime('now'), 3);
INSERT INTO posts VALUES(NULL, 'Como é possível colocar aqui um animal sem saber se é dócil com as crianças????', 3, 2, DateTime('now'), 3);
INSERT INTO posts VALUES(NULL, 'Este cão não devia estar listado.', 3, 2, DateTime('now'), NULL);
INSERT INTO posts VALUES(NULL, 'O Zafir precisa de uma família.', 1, 2, DateTime('now'), 7);


INSERT INTO wishlist VALUES(NULL, 'cats', 2);
INSERT INTO wish_pets VALUES(1, 1);
INSERT INTO wishlist VALUES(NULL, 'sweets', 2);
INSERT INTO wish_pets VALUES(2, 6);
INSERT INTO wish_pets VALUES(2, 2);

INSERT INTO proposal VALUES(NULL, 'I think I can give Zafir  better life.', DateTime('now'), 'valongo', 1, 2, 2);
INSERT INTO proposal_photo VALUES(NULL, 'garden2.jpg', 1);
INSERT INTO proposal VALUES(NULL, 'Zafir will love my garden.', DateTime('now'), 'Gaia', 1, 3, 2);
INSERT INTO proposal_photo VALUES(NULL, 'garden.jpg', 2);
