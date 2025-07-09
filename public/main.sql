create table admin
(
    id          int auto_increment
        primary key,
    username    varchar(255)                            null,
    password    varchar(32)                             null,
    name        varchar(255)                            null,
    email       varchar(255)                            null,
    bakiye      double(10, 2) default 0.00              null,
    parabirimi  varchar(25)   default 'TRY'             not null,
    durum       int                                     null,
    sifresi     varchar(64)                             null,
    telefon     varchar(20)                             null,
    postakodu   int                                     null,
    ulke        varchar(255)                            not null,
    il          varchar(32)                             null,
    ilce        varchar(32)                             null,
    dt          date                                    null,
    tc          bigint                                  null,
    spor        int           default 0                 not null,
    casino      int           default 0                 not null,
    cekim       int           default 0                 not null,
    `2factor`   int           default 1                 not null,
    aff         int           default 1                 not null,
    bayisi      varchar(255)                            not null,
    songirisi   varchar(50)                             null,
    kayit_ip    text                                    null,
    kayit_tarih timestamp     default CURRENT_TIMESTAMP not null,
    cevrim      varchar(255)  default '0'               not null,
    songiris    varchar(255)                            null,
    songirisip  varchar(255)                            not null
)
    charset = utf8mb3
    row_format = DYNAMIC;

create table admin_bans
(
    id           int                  not null
        primary key,
    yonetici_id  int                  null,
    kullanici_id int                  null,
    `not`        text charset utf8mb3 null,
    tarih        text                 null
)
    engine = MyISAM
    charset = latin1
    row_format = DYNAMIC;

create table admin_permissions
(
    permission_id   int  not null
        primary key,
    permission_name text not null
)
    charset = utf8mb3
    row_format = DYNAMIC;

create table admin_role_permissions
(
    id            int not null
        primary key,
    user_id       int not null,
    permission_id int not null
)
    charset = utf8mb3
    row_format = DYNAMIC;

create table admin_session
(
    id          int         not null
        primary key,
    admin_id    int         null,
    ip          varchar(16) null,
    browser     varchar(32) null,
    login_time  int         null,
    last_active int         null,
    os          varchar(10) null,
    active      int         null
)
    charset = utf8mb3
    row_format = DYNAMIC;

create table ayarlar
(
    id             int           not null
        primary key,
    casinolimit    varchar(255)  not null,
    site_adi       text          not null,
    site_aciklama  text          not null,
    site_kelimeler text          not null,
    footer_desc    text          not null,
    site_durum     int           not null,
    homespor       int default 0 not null,
    logo           varchar(255)  not null,
    favicon        varchar(255)  not null,
    telegram       varchar(70)   not null,
    instagram      varchar(70)   not null,
    twitter        varchar(70)   not null,
    smsadet        int           not null,
    dogrulama      int           not null,
    yoneticicode   varchar(255)  not null
)
    charset = utf8mb3
    row_format = DYNAMIC;

create table bonus_claims
(
    id           int auto_increment
        primary key,
    user_id      int                                      not null,
    username     varchar(255)                             not null,
    bonus_id     int                                      not null,
    bonus_name   varchar(255)                             not null,
    bonus_amount decimal(10, 2) default 0.00              not null,
    claimed_at   datetime       default CURRENT_TIMESTAMP not null
)
    collate = utf8mb4_general_ci;

create table bonuses
(
    id                int auto_increment
        primary key,
    bonus_name        varchar(255)                             not null,
    bonus_image       varchar(255)                             null,
    bonus_description text                                     null,
    bonus_amount      decimal(10, 2) default 0.00              not null,
    maxtutar          int            default 0                 not null,
    deneme            int            default 0                 not null,
    hosgeldin         int            default 0                 not null,
    yuzde             int            default 0                 not null,
    cevrim            int            default 0                 not null,
    kayip             int            default 0                 not null,
    yatirim           int            default 0                 not null,
    altlimit          int            default 0                 not null,
    created_at        datetime       default CURRENT_TIMESTAMP null,
    aktif             varchar(25)    default '1'               not null
)
    collate = utf8mb4_general_ci;

create table bulten
(
    id            int auto_increment
        primary key,
    eventid       varchar(50)               not null,
    botid         varchar(50)               null,
    pluskod       varchar(50)               null,
    hitit_kod     varchar(50)               null,
    baslangic     datetime                  null,
    evsahibi_isim varchar(255)              null,
    misafir_isim  varchar(255)              null,
    lig_isim      varchar(255)              null,
    lig_id        int          default 0    null,
    ulke_isim     varchar(255)              null,
    ulke_id       int          default 0    null,
    ligresim      int          default 0    null,
    mackodu       varchar(50)               null,
    istatistik    int          default 0    null,
    oran_adet     int          default 0    null,
    tur           varchar(50)               null,
    tip           int          default 0    null,
    oran1         double(7, 2) default 0.00 null,
    oran0         double(7, 2) default 0.00 null,
    oran2         double(7, 2) default 0.00 null,
    sportid       int          default 0    null,
    mbs           int          default 0    null,
    countrySlug   varchar(255)              null,
    manuelmi      int                       not null,
    constraint unique_eventid
        unique (eventid)
)
    collate = utf8mb4_general_ci
    row_format = DYNAMIC;

create table cache
(
    `key`      varchar(255) not null
        primary key,
    value      mediumtext   not null,
    expiration int          not null
)
    collate = utf8mb4_unicode_ci;

create table cache_locks
(
    `key`      varchar(255) not null
        primary key,
    owner      varchar(255) not null,
    expiration int          not null
)
    collate = utf8mb4_unicode_ci;

create table canli_casino
(
    id     int auto_increment
        primary key,
    gorsel varchar(255)            not null,
    url    varchar(255) default '' null,
    sira   int                     not null
)
    collate = utf8mb4_general_ci;

create table canlibulten
(
    id            int auto_increment
        primary key,
    mac_id        varchar(50)  not null,
    sportid       varchar(50)  null,
    betradar_id   varchar(50)  null,
    skor          varchar(50)  null,
    baslangic     datetime     null,
    dakika        varchar(10)  null,
    sure_detay    varchar(50)  null,
    oynuyormu     varchar(10)  null,
    aktifmi       varchar(10)  null,
    ulke          varchar(100) null,
    ulke_id       varchar(50)  null,
    lig           varchar(100) null,
    lig_id        varchar(50)  null,
    oran_adet     varchar(50)  null,
    tip           varchar(50)  null,
    tur           varchar(50)  null,
    evsahibi_isim varchar(100) null,
    misafir_isim  varchar(100) null,
    constraint mac_id
        unique (mac_id)
)
    charset = utf8mb3
    row_format = DYNAMIC;

create table casino_oyunlari
(
    id     int auto_increment
        primary key,
    gorsel varchar(255)            not null comment 'Örn: /images/game1.webp',
    url    varchar(255) default '' null comment 'Boşsa tıklanmasın',
    sira   int                     not null comment '1,2,3...'
)
    collate = utf8mb4_general_ci;

create table dark_country
(
    id           int                  not null
        primary key,
    countryid    int                  null,
    name         text charset utf8mb3 null,
    live         int default 0        not null,
    coupon_limit int default 2500     not null,
    slug         varchar(255)         null,
    sportid      int                  null,
    status       int default 1        null,
    listindex    int default 999      null
)
    engine = MyISAM
    charset = latin1
    row_format = DYNAMIC;

create table dark_leagues
(
    id           int                  not null
        primary key,
    leaguesid    int                  null,
    name         text charset utf8mb3 null,
    live         int default 0        not null,
    coupon_limit int default 2500     not null,
    countryid    int                  null,
    sportid      int                  null,
    status       int default 1        null,
    listindex    int default 999      null,
    popular      int default 0        null
)
    engine = MyISAM
    charset = latin1
    row_format = DYNAMIC;

create table dark_sports
(
    id           int                                not null
        primary key,
    sportid      int                                null,
    name         text                               not null,
    live         int          default 0             not null,
    coupon_limit int          default 2500          not null,
    icon         varchar(255) default 'icon-futsal' null,
    status       int          default 1             null,
    listindex    int          default 999           null
)
    engine = MyISAM
    charset = utf8mb3
    row_format = DYNAMIC;

create table duyuru
(
    id         int auto_increment
        primary key,
    resim      varchar(255)                       not null,
    url        varchar(255)                       not null,
    konu       varchar(255)                       not null,
    aciklama   text                               not null,
    created_at datetime default CURRENT_TIMESTAMP null
)
    collate = utf8mb4_general_ci;

create table failed_jobs
(
    id         bigint unsigned auto_increment
        primary key,
    uuid       varchar(255)                        not null,
    connection text                                not null,
    queue      text                                not null,
    payload    longtext                            not null,
    exception  longtext                            not null,
    failed_at  timestamp default CURRENT_TIMESTAMP not null,
    constraint failed_jobs_uuid_unique
        unique (uuid)
)
    collate = utf8mb4_unicode_ci;

create table games
(
    id              bigint unsigned auto_increment
        primary key,
    provider_id     int unsigned           not null,
    game_server_url varchar(191)           null,
    game_id         varchar(191)           not null,
    game_name       varchar(191)           not null,
    game_code       varchar(191)           not null,
    game_type       varchar(191)           null,
    description     varchar(191)           null,
    cover           varchar(191)           null,
    status          varchar(191)           not null,
    technology      varchar(191)           null,
    has_lobby       tinyint    default 0   not null,
    is_mobile       tinyint    default 0   not null,
    has_freespins   tinyint    default 0   not null,
    has_tables      tinyint    default 0   not null,
    only_demo       tinyint    default 0   null,
    rtp             bigint                 not null comment 'Controle de RTP em porcentagem',
    distribution    varchar(191)           not null comment 'O nome do provedor',
    views           bigint     default 0   not null,
    is_featured     tinyint(1) default 0   null,
    show_home       tinyint(1) default 0   null,
    created_at      timestamp              null,
    updated_at      timestamp              null,
    ikincilmi       varchar(25)            not null,
    url             varchar(255)           not null,
    turnuva         varchar(5) default '0' not null,
    jackpot         varchar(5) default '0' not null,
    freespin        varchar(5) default '0' not null,
    `drop`          varchar(5) default '0' not null,
    populer         varchar(5) default '0' not null,
    eniyi           varchar(5) default '0' not null,
    megaways        varchar(5) default '0' not null,
    demolink        varchar(255)           not null
)
    engine = MyISAM
    collate = utf8mb4_unicode_ci
    row_format = DYNAMIC;

create index games_game_code_index
    on games (game_code);

create index games_provider_id_index
    on games (provider_id);

create table job_batches
(
    id             varchar(255) not null
        primary key,
    name           varchar(255) not null,
    total_jobs     int          not null,
    pending_jobs   int          not null,
    failed_jobs    int          not null,
    failed_job_ids longtext     not null,
    options        mediumtext   null,
    cancelled_at   int          null,
    created_at     int          not null,
    finished_at    int          null
)
    collate = utf8mb4_unicode_ci;

create table jobs
(
    id           bigint unsigned auto_increment
        primary key,
    queue        varchar(255)     not null,
    payload      longtext         not null,
    attempts     tinyint unsigned not null,
    reserved_at  int unsigned     null,
    available_at int unsigned     not null,
    created_at   int unsigned     not null
)
    collate = utf8mb4_unicode_ci;

create index jobs_queue_index
    on jobs (queue);

create table kupon
(
    id          int auto_increment
        primary key,
    userid      int           null,
    ad          varchar(255)  null,
    miktar      float         null,
    oran        float         null,
    tarih       datetime      null,
    durum       int default 0 null,
    sil         int           null,
    kesim       int           null,
    odeme       double        null,
    iptal       int           null,
    ip          varchar(255)  null,
    odendi      int           null,
    canli       int           null,
    sonmactarih int           null,
    toplam      int           null,
    kazanan     int           null,
    skontrol    int           null,
    bonus       int           null,
    numara      varchar(15)   null
)
    charset = utf8mb3
    row_format = COMPACT;

create index id
    on kupon (id);

create table kupon_mac
(
    id          int auto_increment
        primary key,
    oranid      int                     null,
    kuponid     int                     null,
    userid      int                     null,
    oran        float                   null,
    tur         varchar(100)            null,
    macid       int                     null,
    sonuc       int         default 0   null,
    tarih       datetime                null,
    canli       int                     null,
    session_id  int                     null,
    canlidakika varchar(20)             null,
    skor        varchar(10)             null,
    iptal       int                     null,
    aciklamasi  varchar(100)            null,
    orangrup    varchar(100)            null,
    evsahibi    varchar(200)            null,
    deplasman   varchar(200)            null,
    mackodu     varchar(100)            null,
    sport_id    varchar(50) default '1' not null,
    matchdate   varchar(255)            null,
    result      int         default 1   not null,
    canliskor   varchar(15)             not null,
    botid       int                     not null
)
    charset = utf8mb3
    row_format = COMPACT;

create index kupon_sonuc2
    on kupon_mac (oranid, oran, skor, session_id);

create index kupon_sonuc3
    on kupon_mac (kuponid, sonuc);

create table match_options
(
    id           int auto_increment
        primary key,
    eventid      varchar(50)    not null,
    option_type  varchar(50)    not null,
    option_value varchar(50)    not null,
    odds         decimal(10, 2) not null
)
    collate = utf8mb4_unicode_ci
    row_format = DYNAMIC;

create table message_replies
(
    id         int auto_increment
        primary key,
    message_id int                                not null,
    user_id    int                                not null,
    content    text                               null,
    created_at datetime default CURRENT_TIMESTAMP not null
)
    collate = utf8mb4_general_ci;

create table messages
(
    id         int auto_increment
        primary key,
    uye        int        default 0                 not null,
    mesajturu  varchar(50)                          null,
    baslik     varchar(255)                         null,
    icerik     text                                 null,
    goruldu    tinyint(1) default 0                 not null,
    created_at datetime   default CURRENT_TIMESTAMP null
)
    collate = utf8mb4_general_ci;

create table migrations
(
    id        int unsigned auto_increment
        primary key,
    migration varchar(255) not null,
    batch     int          not null
)
    collate = utf8mb4_unicode_ci;

create table odd_services
(
    id             int                                 not null
        primary key,
    betsapitechkey varchar(100)                        not null,
    name           varchar(255)                        not null,
    list           varchar(255)                        not null,
    odds           varchar(255)                        not null,
    active         int       default 1                 not null,
    created_at     timestamp default CURRENT_TIMESTAMP not null,
    updated_at     timestamp default CURRENT_TIMESTAMP not null on update CURRENT_TIMESTAMP
)
    charset = latin1
    row_format = DYNAMIC;

create table odds_types
(
    id   int          not null
        primary key,
    name varchar(255) not null
)
    collate = utf8mb4_unicode_ci
    row_format = DYNAMIC;

create table oyunlar
(
    id     int auto_increment
        primary key,
    gorsel varchar(255)            not null,
    url    varchar(255) default '' null,
    sira   int                     not null
)
    collate = utf8mb4_general_ci;

create table paracek
(
    id         int auto_increment
        primary key,
    uye        varchar(10) charset latin1          null,
    banka      varchar(50)                         null,
    miktar     varchar(10) charset latin1          null,
    tarih      timestamp default CURRENT_TIMESTAMP null,
    durum      int       default 0                 null,
    turu       varchar(155) charset latin1         null,
    aciklama   varchar(100)                        null,
    notttttt   varchar(780)                        null,
    sube       varchar(50) charset latin1          null,
    hesap      varchar(50) charset latin1          null,
    iban       varchar(50) charset latin1          null,
    created_at timestamp default CURRENT_TIMESTAMP null,
    updated_at timestamp default CURRENT_TIMESTAMP null on update CURRENT_TIMESTAMP,
    firma_key  varchar(50)                         null,
    token      varchar(255)                        null,
    user_id    int                                 null,
    name       varchar(255)                        null,
    telefon    varchar(255)                        null,
    email      varchar(255)                        null
)
    charset = utf8mb3
    row_format = DYNAMIC;

create table parayatir
(
    id       int auto_increment
        primary key,
    uye      varchar(10)                            null,
    adsoyad  varchar(50)                            null,
    tc       varchar(11)                            null,
    banka    varchar(100)                           null,
    islemno  varchar(200)                           null,
    miktar   varchar(10)                            null,
    tur      varchar(50)                            null,
    aciklama varchar(250)                           null,
    tarih    timestamp    default CURRENT_TIMESTAMP null,
    durum    int          default 1                 null,
    bonus    varchar(150) default '5'               null,
    note     varchar(255)                           null
)
    engine = MyISAM
    charset = utf8mb3
    row_format = DYNAMIC;

create table password_reset_tokens
(
    email      varchar(255) not null
        primary key,
    token      varchar(255) not null,
    created_at timestamp    null
)
    collate = utf8mb4_unicode_ci;

create table providers
(
    id           bigint unsigned    not null
        primary key,
    cover        varchar(255)       null,
    code         varchar(50)        null,
    name         varchar(50)        null,
    image        varchar(255)       null,
    status       tinyint default 1  not null,
    rtp          bigint  default 90 null,
    views        bigint  default 1  null,
    distribution varchar(50)        null,
    created_at   timestamp          null,
    updated_at   timestamp          null
)
    engine = MyISAM
    collate = utf8mb4_unicode_ci
    row_format = DYNAMIC;

create table sessions
(
    id            varchar(255)    not null
        primary key,
    user_id       bigint unsigned null,
    ip_address    varchar(45)     null,
    user_agent    text            null,
    payload       longtext        not null,
    last_activity int             not null
)
    collate = utf8mb4_unicode_ci;

create index sessions_last_activity_index
    on sessions (last_activity);

create index sessions_user_id_index
    on sessions (user_id);

create table slider
(
    id     int auto_increment
        primary key,
    gorsel varchar(255) null comment 'Örn: /images/1.webp',
    url    varchar(255) null comment 'Boşsa tıklanmasın, varsa yönlendirilsin',
    sira   int          null comment 'Sıralama değeri (1,2,3...)'
)
    charset = utf8mb3;

create table transactions
(
    id            int auto_increment
        primary key,
    user_id       int                           not null,
    type          enum ('bet', 'win', 'refund') not null,
    amount        decimal(10, 2)                not null,
    created_at    varchar(255)                  null,
    gamename      varchar(50)                   not null,
    transactionid varchar(255)                  not null,
    gameid        varchar(255)                  not null,
    session_id    varchar(255)                  not null
)
    collate = utf8mb4_unicode_ci
    row_format = DYNAMIC;

create table users
(
    id                bigint unsigned auto_increment
        primary key,
    name              varchar(255) not null,
    email             varchar(255) not null,
    email_verified_at timestamp    null,
    password          varchar(255) not null,
    remember_token    varchar(100) null,
    created_at        timestamp    null,
    updated_at        timestamp    null,
    constraint users_email_unique
        unique (email)
)
    collate = utf8mb4_unicode_ci;

create table yoneticiler
(
    id                 int auto_increment
        primary key,
    kullanici_adi      varchar(50)                           not null,
    sifre              varchar(255)                          not null,
    eposta             varchar(100)                          not null,
    yetki              varchar(20) default 'admin'           not null,
    olusturulma_tarihi datetime    default CURRENT_TIMESTAMP not null
)
    collate = utf8mb4_general_ci;

