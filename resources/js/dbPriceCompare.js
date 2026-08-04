// ============================================================
//  DATABASE  –  Game Price Compare
//  Semua data game, toko, dan harga ada di sini.
//  Nanti di Laravel, data ini akan diganti dengan data dari
//  backend (API / Blade). Untuk sekarang pakai data statis.
// ============================================================

window.games = [
  {
    id: "witcher-1",
    title: "The Witcher",
    thumbnail: "https://picsum.photos/seed/witcher1/100/100",
    stores: [
      { store: "G2A",        price: 345000, originalPrice: 375000, discountPercent: 8,    url: "https://www.g2a.com" },
      { store: "Epic Games", price: 355810, originalPrice: null,   discountPercent: null, url: "https://www.epicgames.com" },
      { store: "Steam",      price: 395410, originalPrice: null,   discountPercent: null, url: "https://store.steampowered.com" },
      { store: "GOG",        price: 267670, originalPrice: null,   discountPercent: null, url: "https://www.gog.com" }
    ]
  },
  {
    id: "witcher-2",
    title: "The Witcher 2",
    thumbnail: "https://picsum.photos/seed/witcher2/100/100",
    stores: [
      { store: "G2A",        price: 289000, originalPrice: 340000, discountPercent: calculateDiscount(289000, 340000), url: "https://www.g2a.com" },
      { store: "Epic Games", price: 310500, originalPrice: null,   discountPercent: calculateDiscount(310500, null), url: "https://www.epicgames.com" },
      { store: "Steam",      price: 320000, originalPrice: null,   discountPercent: calculateDiscount(320000, null), url: "https://store.steampowered.com" },
      { store: "GOG",        price: 445000, originalPrice: null,   discountPercent: calculateDiscount(445000, null), url: "https://www.gog.com" },
      { store: "Origin",     price: 300000, originalPrice: 350000, discountPercent: calculateDiscount(300000, 350000), url: "https://www.origin.com" },
      { store: "Xbox Store", price: 295000, originalPrice: 340000, discountPercent: calculateDiscount(295000, 340000), url: "https://www.xbox.com" },
      { store: "PlayStation", price: 315000, originalPrice: null,   discountPercent: calculateDiscount(315000, null), url: "https://www.playstation.com" },
      { store: "Humble",     price: 280000, originalPrice: 340000, discountPercent: calculateDiscount(280000, 340000), url: "https://www.humblebundle.com" }
    ]
  },
  {
    id: "witcher-3",
    title: "The Witcher 3",
    thumbnail: "https://picsum.photos/seed/witcher3/100/100",
    stores: [
      { store: "G2A",        price: 599000, originalPrice: null,   discountPercent: calculateDiscount(599000, null), url: "https://www.g2a.com" },
      { store: "Epic Games", price: 670000, originalPrice: null,   discountPercent: calculateDiscount(670000, null), url: "https://www.epicgames.com" },
      { store: "Steam",      price: 670000, originalPrice: null,   discountPercent: calculateDiscount(670000, null), url: "https://store.steampowered.com" },
      { store: "GOG",        price: 512300, originalPrice: 670000, discountPercent: calculateDiscount(512300, 670000), url: "https://www.gog.com" },
      { store: "Origin",     price: 620000, originalPrice: 700000, discountPercent: calculateDiscount(620000, 700000), url: "https://www.origin.com" },
      { store: "Uplay",      price: 650000, originalPrice: null,   discountPercent: calculateDiscount(650000, null), url: "https://www.ubisoft.com" },
      { store: "Xbox Store", price: 590000, originalPrice: 670000, discountPercent: calculateDiscount(590000, 670000), url: "https://www.xbox.com" },
      { store: "PlayStation", price: 630000, originalPrice: 670000, discountPercent: calculateDiscount(630000, 670000), url: "https://www.playstation.com" },
      { store: "Humble",     price: 550000, originalPrice: 670000, discountPercent: calculateDiscount(550000, 670000), url: "https://www.humblebundle.com" },
      { store: "Fanatical",  price: 580000, originalPrice: 670000, discountPercent: calculateDiscount(580000, 670000), url: "https://www.fanatical.com" }
    ]
  },
  {
    id: "witcher-4",
    title: "The Witcher 4",
    thumbnail: "https://picsum.photos/seed/witcher4/100/100",
    stores: [
      { store: "Epic Games", price: 899000, originalPrice: null,   discountPercent: calculateDiscount(899000, null), url: "https://www.epicgames.com" },
      { store: "Steam",      price: 899000, originalPrice: null,   discountPercent: calculateDiscount(899000, null), url: "https://store.steampowered.com" },
      { store: "GOG",        price: 849000, originalPrice: 899000, discountPercent: calculateDiscount(849000, 899000), url: "https://www.gog.com" },
      { store: "Origin",     price: 879000, originalPrice: null,   discountPercent: calculateDiscount(879000, null), url: "https://www.origin.com" },
      { store: "Uplay",      price: 890000, originalPrice: null,   discountPercent: calculateDiscount(890000, null), url: "https://www.ubisoft.com" },
      { store: "Xbox Store", price: 860000, originalPrice: 899000, discountPercent: calculateDiscount(860000, 899000), url: "https://www.xbox.com" },
      { store: "PlayStation", price: 875000, originalPrice: null,   discountPercent: calculateDiscount(875000, null), url: "https://www.playstation.com" },
      { store: "Humble",     price: 839000, originalPrice: 899000, discountPercent: calculateDiscount(839000, 899000), url: "https://www.humblebundle.com" }
    ]
  },
  {
    id: "cyberpunk-2077",
    title: "Cyberpunk 2077",
    thumbnail: "https://picsum.photos/seed/cyber2077/100/100",
    stores: [
      { store: "G2A",        price: 475000, originalPrice: 599000, discountPercent: calculateDiscount(475000, 599000), url: "https://www.g2a.com" },
      { store: "Epic Games", price: 599000, originalPrice: null,   discountPercent: calculateDiscount(599000, null), url: "https://www.epicgames.com" },
      { store: "Steam",      price: 599000, originalPrice: null,   discountPercent: calculateDiscount(599000, null), url: "https://store.steampowered.com" },
      { store: "GOG",        price: 499000, originalPrice: null,   discountPercent: calculateDiscount(499000, null), url: "https://www.gog.com" },
      { store: "Origin",     price: 550000, originalPrice: 599000, discountPercent: calculateDiscount(550000, 599000), url: "https://www.origin.com" },
      { store: "Xbox Store", price: 520000, originalPrice: 599000, discountPercent: calculateDiscount(520000, 599000), url: "https://www.xbox.com" },
      { store: "PlayStation", price: 560000, originalPrice: null,   discountPercent: calculateDiscount(560000, null), url: "https://www.playstation.com" },
      { store: "Humble",     price: 490000, originalPrice: 599000, discountPercent: calculateDiscount(490000, 599000), url: "https://www.humblebundle.com" },
      { store: "Fanatical",  price: 510000, originalPrice: 599000, discountPercent: calculateDiscount(510000, 599000), url: "https://www.fanatical.com" }
    ]
  },
  {
    id: "rdr-2",
    title: "Red Dead Redemption 2",
    thumbnail: "https://picsum.photos/seed/rdr2game/100/100",
    stores: [
      { store: "G2A",        price: 389000, originalPrice: 529000, discountPercent: calculateDiscount(389000, 529000), url: "https://www.g2a.com" },
      { store: "Epic Games", price: 529000, originalPrice: null,   discountPercent: calculateDiscount(529000, null), url: "https://www.epicgames.com" },
      { store: "Steam",      price: 529000, originalPrice: null,   discountPercent: calculateDiscount(529000, null), url: "https://store.steampowered.com" },
      { store: "Rockstar",   price: 469000, originalPrice: null,   discountPercent: calculateDiscount(469000, null), url: "https://www.rockstargames.com" },
      { store: "Origin",     price: 490000, originalPrice: 529000, discountPercent: calculateDiscount(490000, 529000), url: "https://www.origin.com" },
      { store: "Xbox Store", price: 450000, originalPrice: 529000, discountPercent: calculateDiscount(450000, 529000), url: "https://www.xbox.com" },
      { store: "PlayStation", price: 510000, originalPrice: 529000, discountPercent: calculateDiscount(510000, 529000), url: "https://www.playstation.com" },
      { store: "Humble",     price: 420000, originalPrice: 529000, discountPercent: calculateDiscount(420000, 529000), url: "https://www.humblebundle.com" },
      { store: "Fanatical",  price: 440000, originalPrice: 529000, discountPercent: calculateDiscount(440000, 529000), url: "https://www.fanatical.com" }
    ]
  },
  {
    id: "gta-v",
    title: "Grand Theft Auto V",
    thumbnail: "https://picsum.photos/seed/gtavgame/100/100",
    stores: [
      { store: "G2A",        price: 149000, originalPrice: 299000, discountPercent: calculateDiscount(149000, 299000), url: "https://www.g2a.com" },
      { store: "Epic Games", price: 299000, originalPrice: null,   discountPercent: calculateDiscount(299000, null), url: "https://www.epicgames.com" },
      { store: "Steam",      price: 299000, originalPrice: null,   discountPercent: calculateDiscount(299000, null), url: "https://store.steampowered.com" },
      { store: "Rockstar",   price: 199000, originalPrice: null,   discountPercent: calculateDiscount(199000, null), url: "https://www.rockstargames.com" },
      { store: "Origin",     price: 250000, originalPrice: 299000, discountPercent: calculateDiscount(250000, 299000), url: "https://www.origin.com" },
      { store: "Xbox Store", price: 220000, originalPrice: 299000, discountPercent: calculateDiscount(220000, 299000), url: "https://www.xbox.com" },
      { store: "PlayStation", price: 240000, originalPrice: 299000, discountPercent: calculateDiscount(240000, 299000), url: "https://www.playstation.com" },
      { store: "Humble",     price: 180000, originalPrice: 299000, discountPercent: calculateDiscount(180000, 299000), url: "https://www.humblebundle.com" },
      { store: "Fanatical",  price: 190000, originalPrice: 299000, discountPercent: calculateDiscount(190000, 299000), url: "https://www.fanatical.com" },
      { store: "Green Man",  price: 210000, originalPrice: 299000, discountPercent: calculateDiscount(210000, 299000), url: "https://www.greenmangaming.com" }
    ]
  },
  {
    id: "elden-ring",
    title: "Elden Ring",
    thumbnail: "https://picsum.photos/seed/eldenring/100/100",
    stores: [
      { store: "G2A",        price: 489000, originalPrice: 699000, discountPercent: calculateDiscount(489000, 699000), url: "https://www.g2a.com" },
      { store: "Steam",      price: 699000, originalPrice: null,   discountPercent: calculateDiscount(699000, null), url: "https://store.steampowered.com" },
      { store: "Epic Games", price: 650000, originalPrice: 699000, discountPercent: calculateDiscount(650000, 699000), url: "https://www.epicgames.com" },
      { store: "GOG",        price: 679000, originalPrice: null,   discountPercent: calculateDiscount(679000, null), url: "https://www.gog.com" },
      { store: "Origin",     price: 690000, originalPrice: null,   discountPercent: calculateDiscount(690000, null), url: "https://www.origin.com" },
      { store: "Xbox Store", price: 620000, originalPrice: 699000, discountPercent: calculateDiscount(620000, 699000), url: "https://www.xbox.com" },
      { store: "PlayStation", price: 660000, originalPrice: 699000, discountPercent: calculateDiscount(660000, 699000), url: "https://www.playstation.com" },
      { store: "Humble",     price: 580000, originalPrice: 699000, discountPercent: calculateDiscount(580000, 699000), url: "https://www.humblebundle.com" },
      { store: "Fanatical",  price: 600000, originalPrice: 699000, discountPercent: calculateDiscount(600000, 699000), url: "https://www.fanatical.com" },
      { store: "Green Man",  price: 630000, originalPrice: 699000, discountPercent: calculateDiscount(630000, 699000), url: "https://www.greenmangaming.com" }
    ]
  },
  {
    id: "god-of-war",
    title: "God of War",
    thumbnail: "https://picsum.photos/seed/godofwar/100/100",
    stores: [
      { store: "G2A",        price: 319000, originalPrice: 499000, discountPercent: calculateDiscount(319000, 499000), url: "https://www.g2a.com" },
      { store: "Epic Games", price: 499000, originalPrice: null,   discountPercent: calculateDiscount(499000, null), url: "https://www.epicgames.com" },
      { store: "Steam",      price: 499000, originalPrice: null,   discountPercent: calculateDiscount(499000, null), url: "https://store.steampowered.com" },
      { store: "Origin",     price: 450000, originalPrice: 499000, discountPercent: calculateDiscount(450000, 499000), url: "https://www.origin.com" },
      { store: "Xbox Store", price: 420000, originalPrice: 499000, discountPercent: calculateDiscount(420000, 499000), url: "https://www.xbox.com" },
      { store: "PlayStation", price: 460000, originalPrice: 499000, discountPercent: calculateDiscount(460000, 499000), url: "https://www.playstation.com" },
      { store: "Humble",     price: 380000, originalPrice: 499000, discountPercent: calculateDiscount(380000, 499000), url: "https://www.humblebundle.com" },
      { store: "Fanatical",  price: 400000, originalPrice: 499000, discountPercent: calculateDiscount(400000, 499000), url: "https://www.fanatical.com" }
    ]
  },
  {
    id: "god-of-war-ragnarok",
    title: "God of War Ragnarök",
    thumbnail: "https://picsum.photos/seed/ragnarok/100/100",
    stores: [
      { store: "G2A",        price: 549000, originalPrice: 799000, discountPercent: calculateDiscount(549000, 799000), url: "https://www.g2a.com" },
      { store: "Steam",      price: 799000, originalPrice: null,   discountPercent: calculateDiscount(799000, null), url: "https://store.steampowered.com" },
      { store: "Epic Games", price: 750000, originalPrice: 799000, discountPercent: calculateDiscount(750000, 799000), url: "https://www.epicgames.com" },
      { store: "GOG",        price: 780000, originalPrice: null,   discountPercent: calculateDiscount(780000, null), url: "https://www.gog.com" },
      { store: "Origin",     price: 770000, originalPrice: 799000, discountPercent: calculateDiscount(770000, 799000), url: "https://www.origin.com" },
      { store: "Uplay",      price: 785000, originalPrice: null,   discountPercent: calculateDiscount(785000, null), url: "https://www.ubisoft.com" },
      { store: "Xbox Store", price: 720000, originalPrice: 799000, discountPercent: calculateDiscount(720000, 799000), url: "https://www.xbox.com" },
      { store: "PlayStation", price: 760000, originalPrice: 799000, discountPercent: calculateDiscount(760000, 799000), url: "https://www.playstation.com" },
      { store: "Humble",     price: 680000, originalPrice: 799000, discountPercent: calculateDiscount(680000, 799000), url: "https://www.humblebundle.com" },
      { store: "Fanatical",  price: 700000, originalPrice: 799000, discountPercent: calculateDiscount(700000, 799000), url: "https://www.fanatical.com" }
    ]
  },
  {
    id: "baldurs-gate-3",
    title: "Baldur's Gate 3",
    thumbnail: "https://picsum.photos/seed/bg3larian/100/100",
    stores: [
      { store: "G2A",        price: 599000, originalPrice: null,   discountPercent: calculateDiscount(599000, null), url: "https://www.g2a.com" },
      { store: "Steam",      price: 799000, originalPrice: null,   discountPercent: calculateDiscount(799000, null), url: "https://store.steampowered.com" },
      { store: "GOG",        price: 749000, originalPrice: 799000, discountPercent: calculateDiscount(749000, 799000), url: "https://www.gog.com" },
      { store: "Epic Games", price: 780000, originalPrice: null,   discountPercent: calculateDiscount(780000, null), url: "https://www.epicgames.com" },
      { store: "Origin",     price: 790000, originalPrice: null,   discountPercent: calculateDiscount(790000, null), url: "https://www.origin.com" },
      { store: "Xbox Store", price: 750000, originalPrice: 799000, discountPercent: calculateDiscount(750000, 799000), url: "https://www.xbox.com" },
      { store: "PlayStation", price: 770000, originalPrice: null,   discountPercent: calculateDiscount(770000, null), url: "https://www.playstation.com" },
      { store: "Humble",     price: 720000, originalPrice: 799000, discountPercent: calculateDiscount(720000, 799000), url: "https://www.humblebundle.com" }
    ]
  },
  {
    id: "hades-2",
    title: "Hades II",
    thumbnail: "https://picsum.photos/seed/hades2sg/100/100",
    stores: [
      { store: "Steam",      price: 249000, originalPrice: null, discountPercent: calculateDiscount(249000, null), url: "https://store.steampowered.com" },
      { store: "Epic Games", price: 269000, originalPrice: null, discountPercent: calculateDiscount(269000, null), url: "https://www.epicgames.com" },
      { store: "GOG",        price: 259000, originalPrice: null, discountPercent: calculateDiscount(259000, null), url: "https://www.gog.com" },
      { store: "Origin",     price: 265000, originalPrice: null, discountPercent: calculateDiscount(265000, null), url: "https://www.origin.com" },
      { store: "Xbox Store", price: 255000, originalPrice: null, discountPercent: calculateDiscount(255000, null), url: "https://www.xbox.com" },
      { store: "PlayStation", price: 260000, originalPrice: null, discountPercent: calculateDiscount(260000, null), url: "https://www.playstation.com" },
      { store: "Humble",     price: 245000, originalPrice: null, discountPercent: calculateDiscount(245000, null), url: "https://www.humblebundle.com" }
    ]
  }
];