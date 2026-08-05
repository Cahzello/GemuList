const App = {
  games: [
    {
      id: "astro-bot",
      title: "Astro Bot",
      status: "finished",
      score: null,
      review: "",
      img: "/assets/personalScore/posters/astro-bot.jpg",
      imgAlt: "astro-bot",
      hasScore: false
    },
    {
      id: "bloodborne",
      title: "Bloodborne",
      status: "finished",
      score: 8,
      review: "A gothic masterpiece with fast, aggressive combat and haunting world design. Its rewarding challenge, memorable bosses, and rich lore make every victory feel unforgettable.",
      img: "/assets/personalScore/posters/bloodborne.jpg",
      imgAlt: "bloodborne",
      hasScore: true
    },
    {
      id: "chrono-trigger",
      title: "Chrono Trigger",
      status: "dropped",
      score: 5,
      review: "A timeless RPG featuring unforgettable characters, meaningful choices, and seamless storytelling. Its innovative combat and multiple endings still inspire games today.",
      img: "/assets/personalScore/posters/chrono-trigger.jpg",
      imgAlt: "chrono-trigger",
      hasScore: true
    },
    {
      id: "disco-elysium",
      title: "Disco Elysium",
      status: "finished",
      score: 9,
      review: "A groundbreaking narrative RPG where every conversation matters. Exceptional writing, deep role-playing, and unforgettable characters create a truly one-of-a-kind detective.",
      img: "/assets/personalScore/posters/disco-elysium.jpg",
      imgAlt: "disco-elysium",
      hasScore: true,
    },
    {
      id: "elden-ring",
      title: "Elden Ring",
      status: "finished",
      score: 10,
      review: "An open-world masterpiece that turns every horizon into a promise of discovery. Brutal but fair combat and breathtaking scale make it a landmark action RPG.",
      img: "/assets/personalScore/posters/elden-ring.jpg",
      imgAlt: "elden-ring",
      hasScore: true
    },
    {
      id: "hades",
      title: "Hades",
      status: "finished",
      score: 9,
      review: "A roguelike with soul. Snappy combat, gorgeous art, and a story that actually respects your time make every escape attempt a joy to repeat.",
      img: "/assets/personalScore/posters/hades.jpg",
      imgAlt: "hades",
      hasScore: true
    },
    {
      id: "celeste",
      title: "Celeste",
      status: "finished",
      score: 8,
      review: "Tight platforming meets a deeply human story about anxiety and self-doubt. Every death teaches you something, and the soundtrack is unforgettable.",
      img: "/assets/personalScore/posters/celeste.jpg",
      imgAlt: "celeste",
      hasScore: true
    },
    {
      id: "hollow-knight",
      title: "Hollow Knight",
      status: "dropped",
      score: 6,
      review: "A beautiful, atmospheric metroidvania with incredible world design. The difficulty eventually wore me down, but its art and music still linger.",
      img: "/assets/personalScore/posters/hollow-knight.jpg",
      imgAlt: "hollow-knight",
      hasScore: true
    },
    {
      id: "portal-2",
      title: "Portal 2",
      status: "finished",
      score: 9,
      review: "Wickedly clever puzzles wrapped in hilarious writing. Co-op mode is pure genius, and Glados remains one of gaming's best characters.",
      img: "/assets/personalScore/posters/portal-2.jpg",
      imgAlt: "portal-2",
      hasScore: true
    },
    {
      id: "stardew-valley",
      title: "Stardew Valley",
      status: "finished",
      score: 8,
      review: "Cozy farming life done right. Charming characters, satisfying progression, and endless things to do make it dangerously easy to lose whole evenings.",
      img: "/assets/personalScore/posters/stardew-valley.jpg",
      imgAlt: "stardew-valley",
      hasScore: true
    },
    {
      id: "witcher-3",
      title: "The Witcher 3",
      status: "dropped",
      score: 7,
      review: "A vast, gorgeous RPG with superb quest writing. The sheer size of its world made me put it aside, but every moment I played was memorable.",
      img: "/assets/personalScore/posters/witcher-3.jpg",
      imgAlt: "witcher-3",
      hasScore: true
    },
    {
      id: "sekiro",
      title: "Sekiro",
      status: "finished",
      score: 9,
      review: "A razor-sharp action game about patience and rhythm. The posture-based combat is a revelation, and its boss fights are pure adrenaline.",
      img: "/assets/personalScore/posters/sekiro.jpg",
      imgAlt: "sekiro",
      hasScore: true
    },
    {
      id: "undertale",
      title: "Undertale",
      status: "finished",
      score: 9,
      review: "A deceptively simple RPG that rewards empathy and curiosity. Its characters, humor, and unexpected twists make it an unforgettable experience.",
      img: "/assets/personalScore/posters/undertale.jpg",
      imgAlt: "undertale",
      hasScore: true
    },
    {
      id: "outer-wilds",
      title: "Outer Wilds",
      status: "finished",
      score: 10,
      review: "A once-in-a-generation exploration game. Knowledge is your only upgrade, and its emotional finale is worth every second of curiosity.",
      img: "/assets/personalScore/posters/outer-wilds.jpg",
      imgAlt: "outer-wilds",
      hasScore: true
    },
    {
      id: "control",
      title: "Control",
      status: "dropped",
      score: 5,
      review: "Stylish supernatural action with incredible atmosphere. The combat is fun, but the story lost me and I never made it to the ending.",
      img: "/assets/personalScore/posters/control.jpg",
      imgAlt: "control",
      hasScore: true
    },
    {
      id: "cyberpunk-2077",
      title: "Cyberpunk 2077",
      status: "finished",
      score: 9,
      review: "A sprawling open-world RPG with incredible atmosphere and deep story.",
      img: "/assets/personalScore/posters/cyberpunk-2077.jpg",
      imgAlt: "cyberpunk-2077",
      hasScore: true
    },
    {
      id: "red-dead-redemption-2",
      title: "Red Dead Redemption 2",
      status: "finished",
      score: 10,
      review: "An epic western with unmatched detail and a heartbreaking story.",
      img: "/assets/personalScore/posters/red-dead-redemption-2.jpg",
      imgAlt: "red-dead-redemption-2",
      hasScore: true
    },
    {
      id: "gta-v",
      title: "Grand Theft Auto V",
      status: "finished",
      score: 9,
      review: "A massive sandbox with three unforgettable protagonists.",
      img: "/assets/personalScore/posters/gta-v.jpg",
      imgAlt: "gta-v",
      hasScore: true
    },
    {
      id: "baldurs-gate-3",
      title: "Baldur's Gate 3",
      status: "finished",
      score: 10,
      review: "The definitive modern CRPG with endless player freedom.",
      img: "/assets/personalScore/posters/baldurs-gate-3.jpg",
      imgAlt: "baldurs-gate-3",
      hasScore: true
    },
    {
      id: "god-of-war",
      title: "God of War",
      status: "finished",
      score: 9,
      review: "A mythic father-son journey with brutal satisfying combat.",
      img: "/assets/personalScore/posters/god-of-war.jpg",
      imgAlt: "god-of-war",
      hasScore: true
    },
    {
      id: "horizon-zero-dawn",
      title: "Horizon Zero Dawn",
      status: "finished",
      score: 8,
      review: "A gorgeous post-apocalyptic world with robot dinosaurs.",
      img: "/assets/personalScore/posters/horizon-zero-dawn.jpg",
      imgAlt: "horizon-zero-dawn",
      hasScore: true
    },
    {
      id: "spider-man-remastered",
      title: "Marvel's Spider-Man Remastered",
      status: "finished",
      score: 9,
      review: "Web-swinging bliss with a heartfelt story and fluid combat.",
      img: "/assets/personalScore/posters/spider-man-remastered.jpg",
      imgAlt: "spider-man-remastered",
      hasScore: true
    },
    {
      id: "the-last-of-us-part-i",
      title: "The Last of Us Part I",
      status: "finished",
      score: 10,
      review: "A masterclass in emotional storytelling and survival.",
      img: "/assets/personalScore/posters/the-last-of-us-part-i.jpg",
      imgAlt: "the-last-of-us-part-i",
      hasScore: true
    },
    {
      id: "ghost-of-tsushima",
      title: "Ghost of Tsushima DIRECTOR'S CUT",
      status: "finished",
      score: 9,
      review: "A stunning samurai epic with breathtaking swordplay.",
      img: "/assets/personalScore/posters/ghost-of-tsushima.jpg",
      imgAlt: "ghost-of-tsushima",
      hasScore: true
    },
    {
      id: "days-gone",
      title: "Days Gone",
      status: "finished",
      score: 7,
      review: "An underrated open-world zombie saga on a roaring motorcycle.",
      img: "/assets/personalScore/posters/days-gone.jpg",
      imgAlt: "days-gone",
      hasScore: true
    },
    {
      id: "death-stranding",
      title: "Death Stranding",
      status: "finished",
      score: 8,
      review: "A strange beautiful journey about connection and delivery.",
      img: "/assets/personalScore/posters/death-stranding.jpg",
      imgAlt: "death-stranding",
      hasScore: true
    },
    {
      id: "detroit-become-human",
      title: "Detroit: Become Human",
      status: "finished",
      score: 8,
      review: "A gripping narrative where every choice changes the story.",
      img: "/assets/personalScore/posters/detroit-become-human.jpg",
      imgAlt: "detroit-become-human",
      hasScore: true
    },
    {
      id: "mass-effect-legendary",
      title: "Mass Effect Legendary Edition",
      status: "finished",
      score: 9,
      review: "The ultimate sci-fi trilogy with a crew that feels like family.",
      img: "/assets/personalScore/posters/mass-effect-legendary.jpg",
      imgAlt: "mass-effect-legendary",
      hasScore: true
    },
    {
      id: "skyrim",
      title: "The Elder Scrolls V: Skyrim Special Edition",
      status: "finished",
      score: 9,
      review: "The iconic open-world fantasy that never gets old.",
      img: "/assets/personalScore/posters/skyrim.jpg",
      imgAlt: "skyrim",
      hasScore: true
    },
    {
      id: "fallout-4",
      title: "Fallout 4",
      status: "finished",
      score: 8,
      review: "A post-apocalyptic sandbox with deep crafting and exploration.",
      img: "/assets/personalScore/posters/fallout-4.jpg",
      imgAlt: "fallout-4",
      hasScore: true
    },
    {
      id: "fallout-new-vegas",
      title: "Fallout: New Vegas",
      status: "finished",
      score: 9,
      review: "Legendary writing and player choice in the Mojave wasteland.",
      img: "/assets/personalScore/posters/fallout-new-vegas.jpg",
      imgAlt: "fallout-new-vegas",
      hasScore: true
    },
    {
      id: "starfield",
      title: "Starfield",
      status: "dropped",
      score: 6,
      review: "Vast space RPG that never quite reaches the stars.",
      img: "/assets/personalScore/posters/starfield.jpg",
      imgAlt: "starfield",
      hasScore: true
    },
    {
      id: "dark-souls-3",
      title: "Dark Souls III",
      status: "finished",
      score: 9,
      review: "The culmination of the series with epic boss fights.",
      img: "/assets/personalScore/posters/dark-souls-3.jpg",
      imgAlt: "dark-souls-3",
      hasScore: true
    },
    {
      id: "dark-souls-remastered",
      title: "Dark Souls Remastered",
      status: "finished",
      score: 9,
      review: "The game that started it all - brutal and brilliant.",
      img: "/assets/personalScore/posters/dark-souls-remastered.jpg",
      imgAlt: "dark-souls-remastered",
      hasScore: true
    },
    {
      id: "monster-hunter-world",
      title: "Monster Hunter: World",
      status: "finished",
      score: 9,
      review: "Hunting colossal beasts with friends is pure joy.",
      img: "/assets/personalScore/posters/monster-hunter-world.jpg",
      imgAlt: "monster-hunter-world",
      hasScore: true
    },
    {
      id: "nier-automata",
      title: "NieR: Automata",
      status: "finished",
      score: 10,
      review: "An existential masterpiece with unforgettable combat and story.",
      img: "/assets/personalScore/posters/nier-automata.jpg",
      imgAlt: "nier-automata",
      hasScore: true
    },
    {
      id: "devil-may-cry-5",
      title: "Devil May Cry 5",
      status: "finished",
      score: 8,
      review: "Stylish over-the-top action that rewards mastery.",
      img: "/assets/personalScore/posters/devil-may-cry-5.jpg",
      imgAlt: "devil-may-cry-5",
      hasScore: true
    },
    {
      id: "metal-gear-solid-v",
      title: "METAL GEAR SOLID V: THE PHANTOM PAIN",
      status: "finished",
      score: 9,
      review: "Tactical stealth perfected with open-ended mission design.",
      img: "/assets/personalScore/posters/metal-gear-solid-v.jpg",
      imgAlt: "metal-gear-solid-v",
      hasScore: true
    },
    {
      id: "resident-evil-2",
      title: "Resident Evil 2",
      status: "finished",
      score: 9,
      review: "A tense remake that recaptures survival horror perfection.",
      img: "/assets/personalScore/posters/resident-evil-2.jpg",
      imgAlt: "resident-evil-2",
      hasScore: true
    },
    {
      id: "resident-evil-4",
      title: "Resident Evil 4",
      status: "finished",
      score: 9,
      review: "The legendary action horror classic reinvented flawlessly.",
      img: "/assets/personalScore/posters/resident-evil-4.jpg",
      imgAlt: "resident-evil-4",
      hasScore: true
    },
    {
      id: "resident-evil-village",
      title: "Resident Evil Village",
      status: "finished",
      score: 8,
      review: "Gothic horror with a dash of action and Lady Dimitrescu.",
      img: "/assets/personalScore/posters/resident-evil-village.jpg",
      imgAlt: "resident-evil-village",
      hasScore: true
    },
    {
      id: "silent-hill-2",
      title: "Silent Hill 2",
      status: "finished",
      score: 9,
      review: "Psychological horror at its most haunting and beautiful.",
      img: "/assets/personalScore/posters/silent-hill-2.jpg",
      imgAlt: "silent-hill-2",
      hasScore: true
    },
    {
      id: "alan-wake-2",
      title: "Alan Wake 2",
      status: "finished",
      score: 9,
      review: "A surreal thriller that blends horror and mystery brilliantly.",
      img: "/assets/personalScore/posters/alan-wake-2.jpg",
      imgAlt: "alan-wake-2",
      hasScore: true
    },
    {
      id: "doom-eternal",
      title: "DOOM Eternal",
      status: "finished",
      score: 9,
      review: "Rip and tear with the best shooter movement around.",
      img: "/assets/personalScore/posters/doom-eternal.jpg",
      imgAlt: "doom-eternal",
      hasScore: true
    },
    {
      id: "doom",
      title: "DOOM",
      status: "finished",
      score: 8,
      review: "A modern reboot that gets the demon slaying right.",
      img: "/assets/personalScore/posters/doom.jpg",
      imgAlt: "doom",
      hasScore: true
    },
    {
      id: "prey",
      title: "Prey",
      status: "finished",
      score: 8,
      review: "A smart immersive sim set on a haunted space station.",
      img: "/assets/personalScore/posters/prey.jpg",
      imgAlt: "prey",
      hasScore: true
    },
    {
      id: "dishonored-2",
      title: "Dishonored 2",
      status: "finished",
      score: 8,
      review: "Supernatural stealth with incredible level design.",
      img: "/assets/personalScore/posters/dishonored-2.jpg",
      imgAlt: "dishonored-2",
      hasScore: true
    },
    {
      id: "deathloop",
      title: "Deathloop",
      status: "finished",
      score: 7,
      review: "A stylish time loop assassin adventure that rewards experimentation.",
      img: "/assets/personalScore/posters/deathloop.jpg",
      imgAlt: "deathloop",
      hasScore: true
    },
    {
      id: "bioshock-infinite",
      title: "BioShock Infinite",
      status: "finished",
      score: 9,
      review: "A breathtaking sky city with a mind-bending story.",
      img: "/assets/personalScore/posters/bioshock-infinite.jpg",
      imgAlt: "bioshock-infinite",
      hasScore: true
    },
    {
      id: "borderlands-3",
      title: "Borderlands 3",
      status: "finished",
      score: 7,
      review: "Looter shooter chaos with hundreds of guns.",
      img: "/assets/personalScore/posters/borderlands-3.jpg",
      imgAlt: "borderlands-3",
      hasScore: true
    },
    {
      id: "far-cry-5",
      title: "Far Cry 5",
      status: "finished",
      score: 7,
      review: "An open-world shooter set in rural Montana.",
      img: "/assets/personalScore/posters/far-cry-5.jpg",
      imgAlt: "far-cry-5",
      hasScore: true
    },
    {
      id: "assassins-creed-odyssey",
      title: "Assassin's Creed Odyssey",
      status: "finished",
      score: 8,
      review: "A huge Greek adventure with satisfying combat.",
      img: "/assets/personalScore/posters/assassins-creed-odyssey.jpg",
      imgAlt: "assassins-creed-odyssey",
      hasScore: true
    },
    {
      id: "assassins-creed-valhalla",
      title: "Assassin's Creed Valhalla",
      status: "finished",
      score: 7,
      review: "Viking raids across a beautiful medieval England.",
      img: "/assets/personalScore/posters/assassins-creed-valhalla.jpg",
      imgAlt: "assassins-creed-valhalla",
      hasScore: true
    },
    {
      id: "watch-dogs-2",
      title: "Watch Dogs 2",
      status: "finished",
      score: 7,
      review: "A colorful hacker playground in San Francisco.",
      img: "/assets/personalScore/posters/watch-dogs-2.jpg",
      imgAlt: "watch-dogs-2",
      hasScore: true
    },
    {
      id: "mafia",
      title: "Mafia: Definitive Edition",
      status: "finished",
      score: 8,
      review: "A cinematic gangster story with a gorgeous city.",
      img: "/assets/personalScore/posters/mafia.jpg",
      imgAlt: "mafia",
      hasScore: true
    },
    {
      id: "sleeping-dogs",
      title: "Sleeping Dogs: Definitive Edition",
      status: "finished",
      score: 8,
      review: "Hong Kong kung-fu open world at its finest.",
      img: "/assets/personalScore/posters/sleeping-dogs.jpg",
      imgAlt: "sleeping-dogs",
      hasScore: true
    },
    {
      id: "yakuza-0",
      title: "Yakuza 0",
      status: "finished",
      score: 9,
      review: "A hilarious brutal crime saga with incredible mini-games.",
      img: "/assets/personalScore/posters/yakuza-0.jpg",
      imgAlt: "yakuza-0",
      hasScore: true
    },
    {
      id: "persona-5-royal",
      title: "Persona 5 Royal",
      status: "finished",
      score: 10,
      review: "Stylish turn-based JRPG perfection with a gripping story.",
      img: "/assets/personalScore/posters/persona-5-royal.jpg",
      imgAlt: "persona-5-royal",
      hasScore: true
    },
    {
      id: "persona-4-golden",
      title: "Persona 4 Golden",
      status: "finished",
      score: 9,
      review: "A cozy murder mystery with unforgettable characters.",
      img: "/assets/personalScore/posters/persona-4-golden.jpg",
      imgAlt: "persona-4-golden",
      hasScore: true
    },
    {
      id: "ori-will-of-the-wisps",
      title: "Ori and the Will of the Wisps",
      status: "finished",
      score: 9,
      review: "A breathtaking metroidvania with stunning visuals.",
      img: "/assets/personalScore/posters/ori-will-of-the-wisps.jpg",
      imgAlt: "ori-will-of-the-wisps",
      hasScore: true
    },
    {
      id: "cuphead",
      title: "Cuphead",
      status: "finished",
      score: 8,
      review: "1930s cartoon run-and-gun with brutally fair bosses.",
      img: "/assets/personalScore/posters/cuphead.jpg",
      imgAlt: "cuphead",
      hasScore: true
    },
    {
      id: "dead-cells",
      title: "Dead Cells",
      status: "finished",
      score: 8,
      review: "Fast-paced roguelike action that keeps you coming back.",
      img: "/assets/personalScore/posters/dead-cells.jpg",
      imgAlt: "dead-cells",
      hasScore: true
    },
    {
      id: "slay-the-spire",
      title: "Slay the Spire",
      status: "finished",
      score: 9,
      review: "The definitive deckbuilding roguelike.",
      img: "/assets/personalScore/posters/slay-the-spire.jpg",
      imgAlt: "slay-the-spire",
      hasScore: true
    },
    {
      id: "binding-of-isaac",
      title: "The Binding of Isaac: Rebirth",
      status: "finished",
      score: 8,
      review: "Endless replayable dungeon crawling with bizarre charm.",
      img: "/assets/personalScore/posters/binding-of-isaac.jpg",
      imgAlt: "binding-of-isaac",
      hasScore: true
    },
    {
      id: "terraria",
      title: "Terraria",
      status: "finished",
      score: 9,
      review: "A massive 2D sandbox adventure packed with content.",
      img: "/assets/personalScore/posters/terraria.jpg",
      imgAlt: "terraria",
      hasScore: true
    },
    {
      id: "factorio",
      title: "Factorio",
      status: "finished",
      score: 10,
      review: "The factory must grow - automation perfection.",
      img: "/assets/personalScore/posters/factorio.jpg",
      imgAlt: "factorio",
      hasScore: true
    },
    {
      id: "rimworld",
      title: "RimWorld",
      status: "finished",
      score: 9,
      review: "A storytelling colony sim where everything can go wrong.",
      img: "/assets/personalScore/posters/rimworld.jpg",
      imgAlt: "rimworld",
      hasScore: true
    },
    {
      id: "satisfactory",
      title: "Satisfactory",
      status: "finished",
      score: 8,
      review: "First-person factory building in a gorgeous alien world.",
      img: "/assets/personalScore/posters/satisfactory.jpg",
      imgAlt: "satisfactory",
      hasScore: true
    },
    {
      id: "subnautica",
      title: "Subnautica",
      status: "finished",
      score: 9,
      review: "Underwater survival with genuine awe and dread.",
      img: "/assets/personalScore/posters/subnautica.jpg",
      imgAlt: "subnautica",
      hasScore: true
    },
    {
      id: "firewatch",
      title: "Firewatch",
      status: "finished",
      score: 7,
      review: "A short intimate tale set in the Wyoming wilderness.",
      img: "/assets/personalScore/posters/firewatch.jpg",
      imgAlt: "firewatch",
      hasScore: true
    },
    {
      id: "edith-finch",
      title: "What Remains of Edith Finch",
      status: "finished",
      score: 9,
      review: "A collection of haunting stories told through unique gameplay.",
      img: "/assets/personalScore/posters/edith-finch.jpg",
      imgAlt: "edith-finch",
      hasScore: true
    },
    {
      id: "journey",
      title: "Journey",
      status: "finished",
      score: 9,
      review: "A wordless masterpiece that connects strangers.",
      img: "/assets/personalScore/posters/journey.jpg",
      imgAlt: "journey",
      hasScore: true
    },
    {
      id: "inside",
      title: "INSIDE",
      status: "finished",
      score: 8,
      review: "A dark atmospheric puzzle-platformer with a haunting world.",
      img: "/assets/personalScore/posters/inside.jpg",
      imgAlt: "inside",
      hasScore: true
    },
    {
      id: "limbo",
      title: "LIMBO",
      status: "finished",
      score: 7,
      review: "A monochrome nightmare that started the indie boom.",
      img: "/assets/personalScore/posters/limbo.jpg",
      imgAlt: "limbo",
      hasScore: true
    },
    {
      id: "it-takes-two",
      title: "It Takes Two",
      status: "finished",
      score: 9,
      review: "The best co-op adventure ever made.",
      img: "/assets/personalScore/posters/it-takes-two.jpg",
      imgAlt: "it-takes-two",
      hasScore: true
    },
    {
      id: "a-way-out",
      title: "A Way Out",
      status: "finished",
      score: 7,
      review: "A gripping co-op prison break with a strong story.",
      img: "/assets/personalScore/posters/a-way-out.jpg",
      imgAlt: "a-way-out",
      hasScore: true
    },
    {
      id: "overcooked-2",
      title: "Overcooked! 2",
      status: "finished",
      score: 7,
      review: "Chaotic co-op cooking that ruins friendships.",
      img: "/assets/personalScore/posters/overcooked-2.jpg",
      imgAlt: "overcooked-2",
      hasScore: true
    },
    {
      id: "rocket-league",
      title: "Rocket League",
      status: "finished",
      score: 8,
      review: "Soccer with rocket cars - simple and addictive.",
      img: "/assets/personalScore/posters/rocket-league.jpg",
      imgAlt: "rocket-league",
      hasScore: true
    },
    {
      id: "fall-guys",
      title: "Fall Guys",
      status: "dropped",
      score: 5,
      review: "Colorful battle royale chaos that got old fast.",
      img: "/assets/personalScore/posters/fall-guys.jpg",
      imgAlt: "fall-guys",
      hasScore: true
    },
    {
      id: "among-us",
      title: "Among Us",
      status: "dropped",
      score: 5,
      review: "Social deduction fun with friends but thin solo.",
      img: "/assets/personalScore/posters/among-us.jpg",
      imgAlt: "among-us",
      hasScore: true
    },
    {
      id: "half-life-2",
      title: "Half-Life 2",
      status: "finished",
      score: 9,
      review: "The legendary shooter that defined a generation.",
      img: "/assets/personalScore/posters/half-life-2.jpg",
      imgAlt: "half-life-2",
      hasScore: true
    },
    {
      id: "left-4-dead-2",
      title: "Left 4 Dead 2",
      status: "finished",
      score: 8,
      review: "Co-op zombie shooting with endless replayability.",
      img: "/assets/personalScore/posters/left-4-dead-2.jpg",
      imgAlt: "left-4-dead-2",
      hasScore: true
    },
    {
      id: "counter-strike-2",
      title: "Counter-Strike 2",
      status: "finished",
      score: 8,
      review: "The competitive FPS standard bearer.",
      img: "/assets/personalScore/posters/counter-strike-2.jpg",
      imgAlt: "counter-strike-2",
      hasScore: true
    },
    {
      id: "dota-2",
      title: "Dota 2",
      status: "dropped",
      score: 6,
      review: "Deep and punishing MOBA that demands everything.",
      img: "/assets/personalScore/posters/dota-2.jpg",
      imgAlt: "dota-2",
      hasScore: true
    },
    {
      id: "team-fortress-2",
      title: "Team Fortress 2",
      status: "finished",
      score: 8,
      review: "Timeless class-based multiplayer charm.",
      img: "/assets/personalScore/posters/team-fortress-2.jpg",
      imgAlt: "team-fortress-2",
      hasScore: true
    },
    {
      id: "rainbow-six-siege",
      title: "Tom Clancy's Rainbow Six Siege",
      status: "finished",
      score: 8,
      review: "Tactical multiplayer with intense destructible combat.",
      img: "/assets/personalScore/posters/rainbow-six-siege.jpg",
      imgAlt: "rainbow-six-siege",
      hasScore: true
    },
    {
      id: "deep-rock-galactic",
      title: "Deep Rock Galactic",
      status: "finished",
      score: 9,
      review: "Rock and stone - the best co-op mining shooter.",
      img: "/assets/personalScore/posters/deep-rock-galactic.jpg",
      imgAlt: "deep-rock-galactic",
      hasScore: true
    },
    {
      id: "valheim",
      title: "Valheim",
      status: "finished",
      score: 8,
      review: "Viking survival crafting with a beautiful low-poly world.",
      img: "/assets/personalScore/posters/valheim.jpg",
      imgAlt: "valheim",
      hasScore: true
    },
    {
      id: "rust",
      title: "Rust",
      status: "dropped",
      score: 5,
      review: "Brutal survival multiplayer that punishes everything.",
      img: "/assets/personalScore/posters/rust.jpg",
      imgAlt: "rust",
      hasScore: true
    },
    {
      id: "hogwarts-legacy",
      title: "Hogwarts Legacy",
      status: "finished",
      score: 8,
      review: "A magical open world that fulfills the wizarding fantasy.",
      img: "/assets/personalScore/posters/hogwarts-legacy.jpg",
      imgAlt: "hogwarts-legacy",
      hasScore: true
    }  ],

  currentFilter: "all",
  sortState: { type: "recent", dir: "asc" },
  selectedGameId: null,
  searchQuery: "",
  currentPage: 1,
  rowsPerPage: 3,

  init() {
    this.renderCards();
    this.initSortBar();
    this.initSearch();
    this.initModal();
    window.addEventListener("resize", () => this.renderCards());
  },

  getFilteredGames() {
    let list = [...this.games];
    if (this.currentFilter === "finished") {
      list = list.filter(g => g.status === "finished");
    } else if (this.currentFilter === "dropped") {
      list = list.filter(g => g.status === "dropped");
    } else if (this.currentFilter === "unrated") {
      list = list.filter(g => !g.hasScore);
    }
    if (this.searchQuery.trim()) {
      const q = this.searchQuery.trim().toLowerCase();
      list = list.filter(g => g.title.toLowerCase().startsWith(q));
      return list;
    }
    this.applySort(list);
    return list;
  },

  applySort(list) {
    if (!this.sortState) return;
    const { type, dir } = this.sortState;
    const mult = dir === "desc" ? -1 : 1;
    if (type === "rating") {
      list.sort((a, b) => mult * ((b.score || 0) - (a.score || 0)));
    } else if (type === "title") {
      list.sort((a, b) => mult * a.title.localeCompare(b.title));
    } else if (type === "recent") {
      if (dir === "desc") list.reverse();
    }
  },

  setFilter(filter) {
    this.currentFilter = filter;
    this.currentPage = 1;
    this.updateSortBarUI();
    this.renderCards();
  },

  cycleSort(type) {
    if (this.sortState.type !== type) {
      this.sortState = { type, dir: "asc" };
    } else {
      this.sortState = { type, dir: this.sortState.dir === "asc" ? "desc" : "asc" };
    }
    this.currentPage = 1;
    this.updateSortBarUI();
    this.renderCards();
  },

  initSortBar() {
    document.querySelectorAll(".sort-bar-btn").forEach(btn => {
      btn.addEventListener("click", () => {
        if (btn.classList.contains("sort-bar-btn1")) this.setFilter("all");
        else if (btn.classList.contains("sort-bar-btn-finished")) this.setFilter("finished");
        else if (btn.classList.contains("sort-bar-btn-dropped")) this.setFilter("dropped");
        else if (btn.classList.contains("sort-bar-btn-unrated")) this.setFilter("unrated");
      });
    });
    const sortRow = document.querySelector(".sort-bar-row-right");
    if (sortRow) {
      sortRow.addEventListener("click", (e) => {
        const option = e.target.closest(".sort-option");
        if (!option) return;
        const type = option.dataset.sort;
        if (type) this.cycleSort(type);
      });
    }
    this.updateSortBarUI();
  },

  updateSortBarUI() {
    document.querySelectorAll(".sort-bar-btn").forEach(btn => {
      btn.classList.remove("bg-[#FF6B35]");
    });
    const activeBtn = document.querySelector(
      this.currentFilter === "all" ? ".sort-bar-btn1" :
      this.currentFilter === "finished" ? ".sort-bar-btn-finished" :
      this.currentFilter === "unrated" ? ".sort-bar-btn-unrated" :
      ".sort-bar-btn-dropped"
    );
    if (activeBtn) activeBtn.classList.add("bg-[#FF6B35]");

    document.querySelectorAll(".sort-option").forEach(el => {
      el.classList.remove("active-desc", "active-asc", "bg-[#FF6B35]");
      const arrow = el.querySelector(".sort-arrow");
      if (arrow) {
        arrow.classList.remove("text-[#F4F4F4]");
        arrow.textContent = "\u2193";
      }
    });

    const active = document.querySelector(".sort-option[data-sort=\"" + this.sortState.type + "\"]");
    if (active) {
      active.classList.add(this.sortState.dir === "desc" ? "active-desc" : "active-asc", "bg-[#FF6B35]");
      const arrow = active.querySelector(".sort-arrow");
      if (arrow) {
        arrow.classList.add("text-[#F4F4F4]");
        arrow.textContent = this.sortState.dir === "asc" ? "\u2193" : "\u2191";
      }
    }
  },

  renderCards() {
    const container = document.querySelector(".cards");
    if (!container) return;
    const games = this.getFilteredGames();
    const pageSize = this.getPageSize();
    const totalPages = Math.max(1, Math.ceil(games.length / pageSize));
    if (this.currentPage > totalPages) this.currentPage = totalPages;
    if (this.currentPage < 1) this.currentPage = 1;

    container.innerHTML = "";
    if (games.length === 0) {
      container.innerHTML = '<p class="text-[rgba(244,244,244,0.72)] text-[18px] py-10">No games match this filter.</p>';
      return;
    }

    const start = (this.currentPage - 1) * pageSize;
    const pageGames = games.slice(start, start + pageSize);

    const grid = document.createElement("div");
    grid.className = "grid grid-cols-2 gap-x-[21px] gap-y-[25px] w-full auto-rows-[1fr] items-stretch min-[901px]:auto-rows-[264px] max-[900px]:grid-cols-1";
    pageGames.forEach(game => {
      grid.appendChild(this.createCard(game));
    });
    container.appendChild(grid);

    if (totalPages > 1) {
      container.appendChild(this.renderPagination(totalPages));
      this.bindPagination();
    }
  },

  getGridColumns() {
    return window.matchMedia("(min-width: 901px)").matches ? 2 : 1;
  },

  getPageSize() {
    return this.getGridColumns() * this.rowsPerPage;
  },

  getPageButtons(current, total) {
    const windowSize = 5;
    if (total <= windowSize + 1) {
      return Array.from({ length: total }, (_, i) => i + 1);
    }
    let start = Math.min(Math.max(current - (windowSize - 1), 1), total - windowSize + 1);
    let end = start + windowSize - 1;
    if (end >= total - 1) {
      start = total - windowSize + 1;
      end = total;
    }
    const result = [];
    for (let p = start; p <= end; p++) result.push(p);
    if (end < total) {
      result.push("...");
      result.push(total);
    }
    return result;
  },
  renderPagination(totalPages) {
    const el = document.createElement("div");
    el.className = "pagination flex items-center justify-center gap-4 mt-[30px] pt-1 max-[480px]:gap-2.5";
    const pagesHtml = this.getPageButtons(this.currentPage, totalPages).map(item => {
      if (item === "...") return '<span class="pagination-ellipsis inline-flex items-center justify-center w-6 text-[rgba(244,244,244,0.72)] text-[14px]">...</span>';
      return '<button type="button" class="pagination-page inline-flex items-center justify-center w-[38px] h-[38px] text-[14px] font-bold text-[#F4F4F4] bg-[#1E1E1E] border border-[rgba(244,244,244,0.15)] rounded-[10px] cursor-pointer transition-colors hover:bg-[rgba(255,107,53,0.2)] hover:border-[#FF6B35] max-[480px]:w-[34px] max-[480px]:h-[34px]' + (item === this.currentPage ? " pagination-page-active bg-[#FF6B35] border-[#FF6B35]" : "") + '" data-page="' + item + '">' + item + '</button>';
    }).join("");
    el.innerHTML =
      '<button type="button" class="pagination-btn pagination-prev inline-flex items-center justify-center min-w-[96px] h-[42px] px-5 text-[14px] font-bold tracking-[0.4px] uppercase text-[#F4F4F4] bg-[#1E1E1E] border border-[rgba(244,244,244,0.15)] rounded-xl cursor-pointer transition-colors hover:bg-[#FF6B35] hover:border-[#FF6B35] disabled:opacity-[0.35] disabled:cursor-not-allowed max-[480px]:min-w-[84px] max-[480px]:px-3.5 max-[480px]:h-10"' + (this.currentPage === 1 ? " disabled" : "") + '>Prev</button>' +
      '<div class="pagination-pages flex items-center justify-center gap-1.5 flex-wrap max-[480px]:gap-1">' + pagesHtml + '</div>' +
      '<button type="button" class="pagination-btn pagination-next inline-flex items-center justify-center min-w-[96px] h-[42px] px-5 text-[14px] font-bold tracking-[0.4px] uppercase text-[#F4F4F4] bg-[#1E1E1E] border border-[rgba(244,244,244,0.15)] rounded-xl cursor-pointer transition-colors hover:bg-[#FF6B35] hover:border-[#FF6B35] disabled:opacity-[0.35] disabled:cursor-not-allowed max-[480px]:min-w-[84px] max-[480px]:px-3.5 max-[480px]:h-10"' + (this.currentPage === totalPages ? " disabled" : "") + '>Next</button>';
    return el;
  },

  bindPagination() {
    const container = document.querySelector(".cards");
    if (!container) return;
    container.querySelector(".pagination-prev")?.addEventListener("click", () => this.prevPage());
    container.querySelector(".pagination-next")?.addEventListener("click", () => this.nextPage());
    container.querySelectorAll(".pagination-page").forEach(btn => {
      btn.addEventListener("click", () => this.goToPage(parseInt(btn.dataset.page, 10)));
    });
  },

  goToPage(page) {
    if (isNaN(page) || page < 1) return;
    const games = this.getFilteredGames();
    const totalPages = Math.max(1, Math.ceil(games.length / this.getPageSize()));
    if (page > totalPages) return;
    this.currentPage = page;
    this.renderCards();
    window.scrollTo(0, 0);
  },

  changePage(delta) {
    this.currentPage += delta;
    this.renderCards();
    window.scrollTo(0, 0);
  },

  prevPage() {
    this.changePage(-1);
  },

  nextPage() {
    this.changePage(1);
  },

  createCard(game) {
    const wrapper = document.createElement("div");
    wrapper.className = "card-wrapper cards-" + game.id + " flex items-stretch w-full cursor-pointer min-w-0 transition-[filter,transform] duration-200 hover:brightness-[1.08] hover:-translate-y-0.5 max-[640px]:flex-col max-[640px]:items-center";
    wrapper.addEventListener("click", () => this.openModal(game.id));

    const isDropped = game.status === "dropped";
    const dotClass = isDropped ? "bg-[#f01]" : "bg-[#FF9F1C]";
    const statusClass = isDropped ? "text-[#ff3c49]" : "text-[#FF9F1C]";
    const reviewText = game.review || "";
    const scoreHtml = game.hasScore
      ? '<div class="card-group inline-block font-extrabold text-[#FF6B35] bg-[#262626] px-2.5 py-0.5 rounded-[20px] leading-[1.3] text-[clamp(24px,4vw,36px)]">' + game.score + '/10</div>'
      : '<div class="card-group card-group-na inline-block font-extrabold text-[rgba(255,107,53,0.4)] bg-[#262626] rounded-[20px] leading-none tracking-[0.5px] text-[16px] px-3.5 py-2">Unrated</div>';

    wrapper.innerHTML =
      '<div class="poster-col relative w-[192px] min-w-0 shrink-0 overflow-hidden rounded-lg flex">' +
        '<img src="' + game.img + '" alt="' + game.imgAlt + '" class="poster-col-img w-full h-full object-cover block flex-1" />' +
        '<div class="status-badge absolute bottom-2 right-0 mr-1.5 z-[2] max-[640px]:top-2 max-[640px]:bottom-auto max-[640px]:right-2 max-[640px]:m-0">' +
          '<button class="btn-label btn-label1 flex items-center justify-center gap-1.5 bg-[#1E1E1E] rounded-[23px] px-3.5 py-1 hover:brightness-[1.2]">' +
            '<div class="btn-label-icon w-[10px] h-[10px] rounded-full shrink-0 -ml-px ' + dotClass + '"></div>' +
            '<p class="btn-label-finished capitalize font-bold leading-none ' + statusClass + '">' + game.status + '</p>' +
          '</button>' +
        '</div>' +
      '</div>' +
      '<div class="card-a card2 w-full max-w-[557px] min-h-[250px] flex flex-col gap-4 shrink-0 text-left bg-[#1E1E1E] pt-[17px] pr-[30px] pb-9 pl-[30px] rounded-[10px] min-[901px]:h-full min-[901px]:min-h-0 max-[640px]:max-w-full">' +
        '<h2 class="card-subtitle2 text-[#FF6B35] text-[clamp(20px,3vw,32px)] font-extrabold leading-none max-[480px]:text-center">' + game.title + '</h2>' +
        '<div class="card-row-inner flex items-start gap-5 flex-1 min-w-0 min-[901px]:items-stretch max-[480px]:flex-col max-[480px]:items-center max-[480px]:gap-4">' +
          '<div class="card-score-col w-auto min-w-[80px] shrink-0 flex flex-col items-center gap-1.5 max-[480px]:w-full max-[480px]:min-w-[60px]">' +
            '<p class="card-text-your-score2 text block pb-2 font-bold text-[#FF9F1C] text-[16px] max-[480px]:text-[13px] max-[480px]:text-center">Your Score :</p>' +
            scoreHtml +
          '</div>' +
          '<div class="review-box border border-transparent rounded-md px-3 py-2.5 h-[120px] text-[14px] leading-[1.5] text-[rgba(244,244,244,0.72)] break-words overflow-y-auto min-w-0 w-full flex flex-col justify-start box-border min-[901px]:h-auto min-[901px]:flex-1 min-[901px]:min-h-0 max-[640px]:bg-transparent">' + reviewText + '</div>' +
        '</div>' +
      '</div>';

    return wrapper;
  },

  initSearch() {
    const input = document.querySelector(".sort-bar-search-input");
    if (!input) return;
    let debounceTimer;
    input.addEventListener("input", () => {
      clearTimeout(debounceTimer);
      debounceTimer = setTimeout(() => {
        this.searchQuery = input.value;
        this.currentPage = 1;
        this.renderCards();
      }, 200);
    });
  },

  initModal() {
    const overlay = document.querySelector(".over");
    if (!overlay) return;
    overlay.querySelector(".over-btn")?.addEventListener("click", () => this.closeModal());
    overlay.querySelector(".over-text-btn8")?.addEventListener("click", () => this.closeModal());
    overlay.querySelectorAll(".over-btn-score, .over-text-button, .over-btn-active").forEach(el => {
      el.addEventListener("click", () => {
        const score = parseInt(el.textContent.trim());
        if (!isNaN(score)) this.selectScore(score);
      });
    });
    const textarea = overlay.querySelector(".input-group-review-input");
    const charCount = overlay.querySelector(".input-group-review-text");
    if (textarea && charCount) {
      textarea.addEventListener("input", () => {
        let len = textarea.value.length;
        if (len > 180) {
          textarea.value = textarea.value.slice(0, 180);
          len = 180;
        }
        charCount.textContent = len + "/180";
      });
    }
    overlay.querySelector(".btn1")?.addEventListener("click", () => this.submitReview());
    if (textarea) {
      textarea.addEventListener("keydown", (e) => {
        if (e.key === "Enter" && !e.shiftKey) {
          e.preventDefault();
          this.submitReview();
        }
      });
    }
    document.querySelector(".over-backdrop")?.addEventListener("click", () => this.closeModal());
  },

  openModal(gameId) {
    this.selectedGameId = gameId;
    const game = this.games.find(g => g.id === gameId);
    if (!game) return;
    const overlay = document.querySelector(".over");
    if (!overlay) return;
    const titleEl = overlay.querySelector(".over-title");
    if (titleEl) titleEl.innerHTML = 'Rate &amp; Review <span class="sub-text-light text-[#FF9F1C]">' + game.title + '</span>';
    this.selectScore(game.score || 0);
    const textarea = overlay.querySelector(".input-group-review-input");
    const charCount = overlay.querySelector(".input-group-review-text");
    if (textarea) {
      textarea.value = (game.review || "").slice(0, 180);
      if (charCount) charCount.textContent = (textarea.value.length) + "/180";
    }
    overlay.classList.add("flex"); overlay.classList.remove("hidden");
    document.querySelector(".over-backdrop")?.classList.add("block"); document.querySelector(".over-backdrop")?.classList.remove("hidden");
    document.body.classList.add("overflow-hidden");
  },

  closeModal() {
    const overlay = document.querySelector(".over");
    if (overlay) overlay.classList.remove("flex"); overlay.classList.add("hidden");
    document.querySelector(".over-backdrop")?.classList.remove("block"); document.querySelector(".over-backdrop")?.classList.add("hidden");
    document.body.classList.remove("overflow-hidden");
    this.selectedGameId = null;
  },

  selectScore(score) {
    const overlay = document.querySelector(".over");
    if (!overlay) return;
    const items = overlay.querySelectorAll(".over-btn-score, .over-text-button");
    const selectedClasses = ["over-btn-selected", "bg-[#FF6B35]", "border-[#FF6B35]", "text-[#F4F4F4]", "shadow-[0_0_20px_rgba(255,107,53,0.3)]"];
    items.forEach(el => selectedClasses.forEach(c => el.classList.remove(c)));
    if (score > 0) {
      items.forEach(el => {
        if (parseInt(el.textContent.trim()) === score) {
          selectedClasses.forEach(c => el.classList.add(c));
        }
      });
    }
  },

  submitReview() {
    if (!this.selectedGameId) return;
    const game = this.games.find(g => g.id === this.selectedGameId);
    if (!game) return;
    const overlay = document.querySelector(".over");
    const textarea = overlay?.querySelector(".input-group-review-input");
    const selectedEl = overlay?.querySelector(".over-btn-selected");
    const score = selectedEl ? parseInt(selectedEl.textContent.trim()) : null;
    const review = textarea ? textarea.value.trim() : "";
    if (score !== null) {
      game.score = score;
      game.hasScore = true;
    }
    game.review = review;
    this.closeModal();
    this.renderCards();
  }
};

document.addEventListener("DOMContentLoaded", () => App.init());

export default App;

