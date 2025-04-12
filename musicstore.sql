CREATE DATABASE musicstore;
USE musicstore;
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description VARCHAR(2000),
    price INT NOT NULL CHECK (price > 0),
    category_id INT NOT NULL,
    image VARCHAR(255),
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);

CREATE TABLE users (
       username VARCHAR(50) PRIMARY KEY,
       password VARCHAR(255) NOT NULL,
       role ENUM('admin', 'user') NOT NULL DEFAULT 'user'
);

CREATE TABLE carts (
       username VARCHAR(50),
       productid INT,
       amount INT CHECK (amount > 0),
       PRIMARY KEY (username, productid),
       FOREIGN KEY (username) REFERENCES users(username) ON DELETE CASCADE,
       FOREIGN KEY (productid) REFERENCES products(id) ON DELETE CASCADE
);


INSERT INTO categories (name)
VALUES ("CD"), 
	   ("Vinyl"),
       ("Cassette");

INSERT INTO products (name, description, price, category_id, image)
VALUES ("143 Spotify Fans First Exclusive Clear Orange Vinyl", "#Spotifyfansfirst 

143 IS A PARTY AND EVERYONE IS INVITED!

Katy Perry has officially launched an exciting new era with the long awaited sixth studio album 143. 

Katy set out to create a bold, exuberant, celebratory dance-pop album with the symbolic 143 numerical expression of love as a throughline message.

The result is a sexy, fearless, return to form for the multifaceted musician with an album jam packed with the empowering, sexy, & provocative pop anthems you've come to love. This is an album with a lot of heart and a lot of BPM.

Get ready to pop off!

Spotify Fans First Exclusive Vinyl:
Exclusive Cover Art
Limited Edition Transparent Orange Vinyl", 850000, 2, "143_Spotify_Fans_First_Exclusive_Clear_Orange_Vinyl_Front.webp"),
       ("143 Exclusive Deluxe Purple Vinyl", "143 IS A PARTY AND EVERYONE IS INVITED!

Katy Perry has officially launched an exciting new era with the long awaited sixth studio album 143.

Katy set out to create a bold, exuberant, celebratory dance-pop album with the symbolic 143 numerical expression of love as a throughline message.

The result is a sexy, fearless, return to form for the multifaceted musician with an album jam packed with the empowering, sexy, & provocative pop anthems you’ve come to love. This is an album with a lot of heart and a lot of BPM.

Get ready to pop off!

Katy Perry Store Exclusive Vinyl:
Limited Edition Gatefold
Sparkle Embossing
Purple Vinyl
Bonus Track", 1050000, 2, "143_Exclusive_Deluxe_Purple_Vinyl_Front.webp"),
       ("143 Standard CD", "143 IS A PARTY AND EVERYONE IS INVITED!

Katy Perry has officially launched an exciting new era with the long awaited sixth studio album 143.

Katy set out to create a bold, exuberant, celebratory dance-pop album with the symbolic 143 numerical expression of love as a throughline message.

The result is a sexy, fearless, return to form for the multifaceted musician with an album jam packed with the empowering, sexy, & provocative pop anthems you’ve come to love. This is an album with a lot of heart and a lot of BPM.

Get ready to pop off!

Standard CD:
Standard Cover Art", 400000, 1, "143_Standard_CD_Front.webp"),
       ("143 Cassette", "143 IS A PARTY AND EVERYONE IS INVITED!", 510000, 3, "143_Cassette_Front.webp"),
       ("143 Store Exclusive Signed Silver Vinyl", "143 IS A PARTY AND EVERYONE IS INVITED!", 850000, 2, "143_Store_Exclusive_Signed_Silver_Vinyl_Front.webp"),
       ("143 Indie Exclusive Clear Blue Vinyl", "143 IS A PARTY AND EVERYONE IS INVITED!", 850000, 2, "143_Indie_Exclusive_Clear_Blue_Vinyl_Front.webp"),
       ("143 Amazon Exclusive Clear Vinyl", "143 IS A PARTY AND EVERYONE IS INVITED!", 850000, 2, "143_Amazon_Exclusive_Clear_Vinyl_Front.webp"),
       ("143 Urban Outfitters Clear Black Vinyl", "143 IS A PARTY AND EVERYONE IS INVITED!", 1020000, 2, "143_Urban_Outfitters_Clear_Black_Vinyl_Front.webp"),
       ("143 Target Exclusive Clear Red Vinyl", "Constains Bonus Track
143 IS A PARTY AND EVERYONE IS INVITED!", 900000, 2, "143_Target_Exclusive_Clear_Red_Vinyl_Front.webp"),
       ("143 Target Exclusive CD", "Constains Bonus Track
143 IS A PARTY AND EVERYONE IS INVITED!", 420000, 1, "143_Target_Exclusive_CD_Front.webp"),
       ("143 Signed CD", "143 IS A PARTY AND EVERYONE IS INVITED!", 360000, 1, "143_Signed_CD_Front.webp"),
       ("Woman’s World Orange 7”", "A very special limited edition pressing of the brand new single, Woman’s World, on orange translucent vinyl.", 360000, 2, "Womans_World_Orange_7_Front.webp"),
       ("Woman’s World CD Single", "A limited edition CD single of the brand new song, Woman’s World.", 80000, 1, "Womans_World_CD_Single_Front.webp"),
       ("Smile CD", "Tracklist
1. Never Really Over
2. Cry About It Later
3. Teary Eyes
4. Daisies 
5. Resilient
6. Not The End of the World
7. Smile
8. Champagne Problems
9. Tucked
10. Harleys in Hawaii
11. Only Love
12. What Makes A Woman", 360000, 1, "Smile_CD_Front.webp"),
       ('The Tortured Poets Department CD + Bonus Track "The Manuscript"', '16 Tracks + Bonus Track “The Manuscript”
Collectible CD album in single jewel case with unique front and back cover art', 340000, 1, "The_Tortured_Poets_Department_CD_+_Bonus_Track_The_Manuscript_Front.webp"),
       ("Midnights: Moonstone Blue Edition CD", "Each CD album includes:
13 Songs
1 of 4 collectible albums with unique front and back cover art
1 of 4 unique, collectible disc artwork
1 of 4 unique marbled color CD discs (the Moonstone Blue Edition features a moonstone blue marbled color disc)
A collectible lyric booklet with never-before-seen photos", 340000, 1, "Midnights_Moonstone_Blue_Edition_CD_Front.webp"),
       ("Lover Standard Edition Physical CD", "1. I Forgot That You Existed
2. Cruel Summer
3. Lover
4. The Man
5. The Archer
6. I Think He Knows
7. Miss Americana & The Heartbreak Prince
8. Paper Rings
9. Cornelia Street
10. Death by a Thousand Cuts
11. London Boy
12. Soon You'll Get Better feat. The Chicks
13. False God
14. You Need to Calm Down
15. Afterglow
16 ME! Featuring Brendon Urie of Panic! At The Disco
17. It's Nice to Have a Friend
18. Daylight", 340000, 1, "Lover_Standard_Edition_Physical_CD_Front.webp"),
       ("1989 (Taylor's Version) CD", '21 Songs
Including 5 previously unreleased songs from The Vault
Collectible CD album in jewel case with unique front and back cover art
1 Disc album with unique collectible disc artwork
A collectible lyric booklet with never-before-seen photos
10"x10" double-sided Foldable Poster
Side 1 includes full size photograph of Taylor Swift
Size 2 includes a print of the original handwritten lyrics of "Welcome to New York"
', 340000, 1, "1989_(Taylors_Version)_CD_Front.webp"),
       ("RED (Taylor's Version) CD", "Each CD album features:
30 songs, including 9 songs from the Vault
Exclusive album booklet with never before seen photos, artwork and lyrics for the 9 songs from the Vault", 400000, 1, "RED_(Taylors_Version)_CD_Front.webp"),
       ("Speak Now (Taylor's Version) CD", "Each CD album includes:
22 Songs
Including 6 previously unreleased Songs From The Vault
Collectible CD album in jewel case with unique front and back cover art
2 Disc album with unique collectible disc artwork
A collectible lyric booklet with never-before-seen photos", 400000, 1, "Speak_Now_(Taylors_Version)_CD_Front.webp"),
       ("Fearless (Taylor's Version) CD", "Each CD album features:
27 songs, including 6 unreleased songs from the vault,
Exclusive album lyric booklet, including full album lyrics and never before seen photos and artwork", 340000, 1, "Fearless_(Taylors_Version)_CD_Front.webp");

INSERT INTO users (username, password, role) VALUES 
('admin', '$2y$10$5GRAylQ9G2X4bqMWWFtomOtxw/eXGbr1ZtxzIm7X8QmU3jxNxh1zq', 'admin'),
('dat', '$2y$10$3z5.LviYKfKZUjWRwG4r7eveouPfqBU/nHPKXp4pERzRx0IXHXmWy', 'user');