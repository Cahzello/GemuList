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
      { store: "G2A",        price: 289000, originalPrice: 340000, discountPercent: 15,   url: "https://www.g2a.com" },
      { store: "Epic Games", price: 310500, originalPrice: null,   discountPercent: null, url: "https://www.epicgames.com" },
      { store: "Steam",      price: 320000, originalPrice: null,   discountPercent: null, url: "https://store.steampowered.com" },
      { store: "GOG",        price: 445000, originalPrice: null,   discountPercent: null, url: "https://www.gog.com" }
    ]
  },
  {
    id: "witcher-3",
    title: "The Witcher 3",
    thumbnail: "https://picsum.photos/seed/witcher3/100/100",
    stores: [
      { store: "G2A",        price: 599000, originalPrice: null,   discountPercent: null, url: "https://www.g2a.com" },
      { store: "Epic Games", price: 670000, originalPrice: null,   discountPercent: null, url: "https://www.epicgames.com" },
      { store: "Steam",      price: 670000, originalPrice: null,   discountPercent: null, url: "https://store.steampowered.com" },
      { store: "GOG",        price: 512300, originalPrice: 670000, discountPercent: 24,   url: "https://www.gog.com" }
    ]
  },
  {
    id: "witcher-4",
    title: "The Witcher 4",
    thumbnail: "https://picsum.photos/seed/witcher4/100/100",
    stores: [
      { store: "Epic Games", price: 899000, originalPrice: null,   discountPercent: null, url: "https://www.epicgames.com" },
      { store: "Steam",      price: 899000, originalPrice: null,   discountPercent: null, url: "https://store.steampowered.com" },
      { store: "GOG",        price: 849000, originalPrice: 899000, discountPercent: 6,    url: "https://www.gog.com" }
    ]
  },
  {
    id: "cyberpunk-2077",
    title: "Cyberpunk 2077",
    thumbnail: "https://picsum.photos/seed/cyber2077/100/100",
    stores: [
      { store: "G2A",        price: 475000, originalPrice: 599000, discountPercent: 21,   url: "https://www.g2a.com" },
      { store: "Epic Games", price: 599000, originalPrice: null,   discountPercent: null, url: "https://www.epicgames.com" },
      { store: "Steam",      price: 599000, originalPrice: null,   discountPercent: null, url: "https://store.steampowered.com" },
      { store: "GOG",        price: 499000, originalPrice: null,   discountPercent: null, url: "https://www.gog.com" }
    ]
  },
  {
    id: "rdr-2",
    title: "Red Dead Redemption 2",
    thumbnail: "https://picsum.photos/seed/rdr2game/100/100",
    stores: [
      { store: "G2A",        price: 389000, originalPrice: 529000, discountPercent: 26,   url: "https://www.g2a.com" },
      { store: "Epic Games", price: 529000, originalPrice: null,   discountPercent: null, url: "https://www.epicgames.com" },
      { store: "Steam",      price: 529000, originalPrice: null,   discountPercent: null, url: "https://store.steampowered.com" },
      { store: "Rockstar",   price: 469000, originalPrice: null,   discountPercent: null, url: "https://www.rockstargames.com" }
    ]
  },
  {
    id: "gta-v",
    title: "Grand Theft Auto V",
    thumbnail: "https://picsum.photos/seed/gtavgame/100/100",
    stores: [
      { store: "G2A",        price: 149000, originalPrice: 299000, discountPercent: 50,   url: "https://www.g2a.com" },
      { store: "Epic Games", price: 299000, originalPrice: null,   discountPercent: null, url: "https://www.epicgames.com" },
      { store: "Steam",      price: 299000, originalPrice: null,   discountPercent: null, url: "https://store.steampowered.com" },
      { store: "Rockstar",   price: 199000, originalPrice: null,   discountPercent: null, url: "https://www.rockstargames.com" }
    ]
  },
  {
    id: "elden-ring",
    title: "Elden Ring",
    thumbnail: "https://picsum.photos/seed/eldenring/100/100",
    stores: [
      { store: "G2A",        price: 489000, originalPrice: 699000, discountPercent: 30,   url: "https://www.g2a.com" },
      { store: "Steam",      price: 699000, originalPrice: null,   discountPercent: null, url: "https://store.steampowered.com" }
    ]
  },
  {
    id: "god-of-war",
    title: "God of War",
    thumbnail: "https://picsum.photos/seed/godofwar/100/100",
    stores: [
      { store: "G2A",        price: 319000, originalPrice: 499000, discountPercent: 36,   url: "https://www.g2a.com" },
      { store: "Epic Games", price: 499000, originalPrice: null,   discountPercent: null, url: "https://www.epicgames.com" },
      { store: "Steam",      price: 499000, originalPrice: null,   discountPercent: null, url: "https://store.steampowered.com" }
    ]
  },
  {
    id: "god-of-war-ragnarok",
    title: "God of War Ragnarök",
    thumbnail: "https://picsum.photos/seed/ragnarok/100/100",
    stores: [
      { store: "G2A",        price: 549000, originalPrice: 799000, discountPercent: 31,   url: "https://www.g2a.com" },
      { store: "Steam",      price: 799000, originalPrice: null,   discountPercent: null, url: "https://store.steampowered.com" }
    ]
  },
  {
    id: "baldurs-gate-3",
    title: "Baldur's Gate 3",
    thumbnail: "https://picsum.photos/seed/bg3larian/100/100",
    stores: [
      { store: "G2A",   price: 599000, originalPrice: null,   discountPercent: null, url: "https://www.g2a.com" },
      { store: "Steam", price: 799000, originalPrice: null,   discountPercent: null, url: "https://store.steampowered.com" },
      { store: "GOG",   price: 749000, originalPrice: 799000, discountPercent: 6,    url: "https://www.gog.com" }
    ]
  },
  {
    id: "hades-2",
    title: "Hades II",
    thumbnail: "https://picsum.photos/seed/hades2sg/100/100",
    stores: [
      { store: "Steam",      price: 249000, originalPrice: null, discountPercent: null, url: "https://store.steampowered.com" },
      { store: "Epic Games", price: 269000, originalPrice: null, discountPercent: null, url: "https://www.epicgames.com" }
    ]
  }
];

