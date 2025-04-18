// Sentiment Analysis Configuration
const sentimentConfig = {
    positiveWords: [
        "amazing",
        "outstanding",
        "incredible",
        "fantastic",
        "superb",
        "wonderful",
        "excellent",
        "awesome",
        "delightful",
        "brilliant",
        "magnificent",
        "inspiring",
        "remarkable",
        "impressive",
        "outstanding",
        "fabulous",
        "top-notch",
        "flawless",
        "splendid",
        "marvelous",
        "out-of-this-world",
        "best",
        "perfect",
        "beautiful",
        "stunning",
        "breathtaking",
        "incredible",
        "amazing",
        "positive",
        "fantastic",
        "inspiring",
        "great",
        "joyful",
        "happy",
        "cheerful",
        "content",
        "exciting",
        "optimistic",
        "radiant",
        "peaceful",
        "pleasant",
        "light",
        "bright",
        "reliable",
        "fun",
        "enthusiastic",
        "comfortable",
        "elegant",
        "trustworthy",
        "successful",
        "friendly",
        "outgoing",
        "joyous",
        "lively",
        "blissful",
        "satisfying",
        "rewarding",
        "delicious",
        "luxurious",
        "high-end",
        "vibrant",
        "convenient",
        "refreshing",
        "heavenly",
        "smooth",
        "rejuvenating",
        "elevated",
        "thrilling",
        "sweet",
        "peaceful",
        "flattering",
        "exquisite",
        "bold",
        "admirable",
        "classy",
        "lovely",
        "graceful",
        "brightened",
        "harmony",
        "secure",
        "dependable",
        "clean",
        "brave",
        "carefree",
        "encouraging",
        "uplifting",
        "affordable",
        "fit",
        "fit-to-serve",
        "efficient",
        "beautifully",
        "loyal",
        "sophisticated",
        "stylish",
        "genuine",
        "charming",
        "magical",
        "wholesome",
        "pristine",
        "inviting",
        "radiant",
        "grateful",
        "admired",
        "secure",
        "funny",
        "awesome",
        "splendid",
        "excellent",
        "friendly",
        "classy",
        "elegant",
        "helpful",
        "generous",
        "wealthy",
        "refreshing",
        "playful",
        "good",
        "sophisticated",
        "dazzling",
        "wonderful",
        "unstoppable",
        "cheerful",
        "active",
        "easy",
        "timeless",
        "refreshing",
        "gracious",
        "well-behaved",
        "neat",
        "vibrant",
        "honest",
        "caring",
        "balanced",
        "engaging",
        "creative",
        "supportive",
        "motivated",
        "peaceful",
        "caring",
        "hearty",
        "vibrant",
        "fit",
        "courageous",
        "fun-filled",
        "fresh",
        "motivational",
        "affirming",
        "mindful",
        "impressive",
        "resourceful",
        "efficient",
        "innovative",
        "successful",
        "reliable",
        "spiritual",
        "trusting",
        "loving",
        "engaging",
        "dependable",
        "charitable",
        "outgoing",
        "adventurous",
        "talented",
        "peace",
        "subtle",
        "charming",
        "playful",
        "peaceful",
        "thankful",
        "vivid",
        "positive",
        "satisfying",
        "resilient",
        "confident",
        "innovative",
        "valuable",
        "mind-blowing",
        "incredible",
        "winning",
        "bright",
        "strong",
        "exceeding",
        "shining",
        "secure",
        "trusting",
        "outstanding",
        "sparkling",
        "stellar",
        "premium",
        "lovely",
        "super",
        "top-tier",
        "exceptional",
        "superior",
        "perfect",
        "valuable",
        "amazing",
        "timeless",
        "highly-rated",
        "one-of-a-kind",
        "phenomenal",
        "gorgeous",
        "radiant",
        "dynamic",
        "rewarding",
        "motivated",
        "successful",
        "inspirational",
        "top-notch",
        "out-of-the-box",
        "excellent",
        "superb",
        "celebrated",
        "impressive",
        "gratifying",
        "unbeatable",
        "effective",
        "real",
        "thriving",
        "bright",
        "generous",
        "active",
        "unique",
        "loving",
        "successful",
        "comfortable",
        "reliable",
        "creative",
        "brilliant",
        "modern",
        "consistent",
        "helpful",
        "luxurious",
        "first-rate",
        "enthusiastic",
        "positive",
        "successful",
        "pristine",
        "warm",
        "dynamic",
        "forward-thinking",
        "rich",
        "inspiring",
        "exceptional",
        "exceptional",
        "unstoppable",
        "charming",
        "elegant",
        "glowing",
        "trustworthy",
        "rewarding",
        "top-tier",
        "delightful",
        "flawless",
        "genuine",
        "energetic",
        "visionary",
        "dependable",
        "highly-rated",
        "encouraging",
        "tasty",
        "delicious",
        "lasting",
        "timeless",
        "blissful",
        "successful",
        "wholesome",
        "celebrated",
        "easy",
        "creative",
        "independent",
        "radiant",
        "unstoppable",
        "dynamic",
        "respectable",
        "sincere",
        "groundbreaking",
        "classic",
        "prosperous",
        "perfect",
        "flawless",
        "honest",
        "encouraging",
        "inspirational",
        "talented",
        "active",
        "invaluable",
        "motivating",
        "beautiful",
        "innovative",
        "motivational",
        "leading",
        "outstanding",
        "luxurious",
        "sparkling",
        "valuable",
        "successful",
        "leading-edge",
        "reliable",
        "remarkable",
        "timeless",
        "spectacular",
        "thrilled",
        "impressive",
        "flourishing",
        "prosperous",
        "glamorous",
        "honorable",
        "exhilarating",
        "radiant",
        "uplifting",
        "flawless",
        "exceptional",
        "profound",
        "elite",
        "optimistic",
        "happy",
        "refined",
        "refreshed",
        "rewarding",
        "outperforming",
        "groundbreaking",
        "motivated",
        "successful",
        "affectionate",
        "outstanding",
        "convenient",
        "smart",
        "elegance",
        "wholesome",
        "superior",
        "carefree",
        "top-tier",
        "cutting-edge",
        "brilliant",
        "bright",
        "luxuriant",
        "incredible",
        "rejuvenating",
        "commendable",
        "efficient",
        "timeless",
        "genuine",
        "unmatched",
        "gratified",
        "sparkling",
        "winning",
        "tender",
        "outdo",
        "thriving",
        "elevating",
        "enduring",
        "phenomenal",
        "graceful",
        "secure",
        "charming",
        "splendid",
        "reliable",
        "noble",
        "impressive",
        "breathtaking",
        "innovative",
        "sustainable",
        "brightened",
        "reliable",
        "flourishing",
        "grace",
        "harmonious",
        "exquisite",
        "soothing",
        "creative",
        "generous",
        "vibrant",
        "heartwarming",
        "top-notch",
        "impactful",
        "compelling",
        "encouraging",
        "dynamic",
        "clear",
        "fresh",
        "classy",
        "motivating",
        "careful",
        "active",
        "benevolent",
        "supportive",
        "good-hearted",
        "nurturing",
        "alluring",
        "inspiring",
        "caring",
        "rising",
        "dependable",
        "expressive",
        "visionary",
        "care",
        "exceptional",
        "glistening",
        "refreshing",
        "energetic",
        "steady",
        "positive",
        "imposing",
        "successful",
        "optimistic",
        "winning",
        "beneficial",
        "brisk",
        "reliable",
        "motivational",
        "gleaming",
        "heartening",
        "flourishing",
        "luxurious",
        "optimistic",
        "engaging",
        "hospitable",
        "charismatic",
        "upbeat",
        "balanced",
        "vibrating",
        "persevering",
        "steady",
        "powerful",
        "accomplished",
        "outstanding",
        "encouraging",
        "admirable",
        "efficient",
        "top-tier",
        "effortless",
        "creative",
        "substantial",
        "appealing",
        "high-quality",
        "beautiful",
        "elevated",
        "classic",
        "upbeat",
        "striking",
        "grand",
        "remarkable",
        "impeccable",
        "celebrated",
        "captivating",
        "successful",
        "satisfying",
        "trustworthy",
        "exceptional",
        "bright",
        "comforting",
        "engrossing",
        "great",
        "compassionate",
        "unique",
        "heartfelt",
        "appreciated",
        "unbelievable",
        "splendid",
        "refreshing",
        "phenomenal",
        "significant",
        "impactful",
        "radiating",
        "brilliant",
        "phenomenal",
        "glorious",
        "magnetic",
        "successful",
        "powerful",
        "admired",
        "sought-after",
        "joyous",
        "amazing",
        "fascinating",
        "magnificent",
        "brave",
        "brightening",
        "peaceful",
        "stunning",
        "outperforming",
        "fruitful",
        "gracious",
        "super",
        "peaceful",
        "acclaimed",
        "flourish",
        "celebrated",
        "mature",
        "reliable",
        "rewarding",
        "generous",
        "outstanding",
        "resourceful",
        "phenomenal",
        "formidable",
        "meaningful",
        "prospering",
        "satisfying",
        "prestigious",
        "highly-rated",
        "skilled",
        "virtuous",
        "high-class",
        "advanced",
        "positive",
        "reliable",
        "dynamic",
        "everlasting",
        "stable",
        "graceful",
        "elevated",
        "acclaimed",
        "legendary",
        "intelligent",
        "refined",
        "optimistic",
        "encouraging",
        "noble",
        "rewarding",
        "authentic",
        "productive",
        "efficient",
        "visionary",
        "distinguished",
        "sophisticated",
        "successful",
        "admirable",
        "elevating",
        "attractive",
        "soothing",
        "brightened",
        "trusted",
        "fascinating",
        "unbeatable",
        "inspiring",
        "adorable",
        "affectionate",
        "agreeable",
        "appreciative",
        "attentive",
        "blissful",
        "brave",
        "calm",
        "caring",
        "charming",
        "cheerful",
        "compassionate",
        "considerate",
        "content",
        "courteous",
        "creative",
        "delightful",
        "devoted",
        "diligent",
        "eager",
        "encouraging",
        "endearing",
        "engaging",
        "enthusiastic",
        "flattering",
        "friendly",
        "grateful",
        "genuine",
        "helpful",
        "hospitable",
        "humble",
        "impressive",
        "inspiring",
        "loving",
        "mindful",
        "motivating",
        "nurturing",
        "optimistic",
        "passionate",
        "polite",
        "respectful",
        "supportive",
        "thoughtful",
        "tolerant",
        "trustworthy",
        "understanding",
        "vibrant",
        "warm",
        "welcoming",
        "wise",
        "zealous",
        "zestful",
        "thoughtful",
        "elegant",
        "precious",
        "gracious",
        "handsome",
        "sincere",
        "remarkable",
        "splendid",
        "considerate",
        "compelling",
        "outgoing",
        "lively",
        "engrossing",
        "reliable",
        "dependable",
        "conscientious",
        "encouraging",
        "positive",
        "friendly",
        "helpful",
        "genuine",
        "playful",
        "trusting",
        "respectful",
        "optimistic",
        "reliable",
        "gentle",
        "patient",
        "joyful",
        "resourceful",
        "innovative",
        "well-meaning",
        "supportive",
        "dedicated",
        "calming",
        "charming",
        "uplifting",
        "balanced",
        "compassionate",
        "informed",
        "open-minded",
        "engaging",
        "thought-provoking",
        "amusing",
        "playful",
        "considerate",
        "accommodating",
        "affable",
        "gracious",
        "empathetic",
        "bright",
        "generous",
        "enthusiastic",
        "hopeful",
        "mindful",
        "articulate",
        "strong",
        "creative",
        "inviting",
        "dependable",
        "motivated",
        "receptive",
        "humorous",
        "admired",
        "polished",
        "hilarious",
        "refreshing",
        "elevated",
        "sophisticated",
        "dazzling",
        "successful",
        "enlightened",
        "peaceful",
        "pleasant",
        "generous",
        "flattering",
        "caring",
        "courageous",
        "peaceful",
        "joyful",
        "intelligent",
        "curious",
        "optimistic",
        "sparkling",
        "enthusiastic",
        "radiant",
        "motivated",
        "supportive",
        "mindful",
        "accepting",
        "motivated",
        "respectful",
        "noble",
        "captivating",
        "supportive",
        "appreciated",
        "trustworthy",
        "determined",
        "committed",
        "polite",
        "graceful",
        "magnanimous",
        "affirmative",
        "joyous",
        "secure",
        "unique",
        "insightful",
        "proactive",
        "committed",
        "exemplary",
        "charming",
        "well-rounded",
        "engaged",
        "exceptional",
        "resourceful",
        "inspiring",
        "passionate",
        "creative",
        "assured",
        "resilient",
        "elevating",
        "genuine",
        "reliable"
    ],
    negativeWords: [
        "angry",
        "annoyed",
        "bitter",
        "blunt",
        "cold",
        "confused",
        "critical",
        "disappointed",
        "disturbed",
        "doubtful",
        "dull",
        "empty",
        "envious",
        "evil",
        "fail",
        "fake",
        "frustrated",
        "guilty",
        "harsh",
        "hopeless",
        "hostile",
        "ignorant",
        "imperfect",
        "impolite",
        "incompetent",
        "inconvenient",
        "indifferent",
        "insensitive",
        "intolerant",
        "irritated",
        "jealous",
        "lazy",
        "liar",
        "lonely",
        "mean",
        "misleading",
        "negative",
        "negligent",
        "nervous",
        "noisy",
        "numb",
        "obnoxious",
        "offensive",
        "overwhelmed",
        "pathetic",
        "poor",
        "pretentious",
        "resentful",
        "rude",
        "sad",
        "selfish",
        "shallow",
        "shocked",
        "sick",
        "stale",
        "stressed",
        "stubborn",
        "subpar",
        "superficial",
        "suspicious",
        "tense",
        "troubled",
        "ugly",
        "uncomfortable",
        "ungrateful",
        "unhappy",
        "unimpressed",
        "unpleasant",
        "unsatisfied",
        "unsuccessful",
        "useless",
        "vicious",
        "violent",
        "weak",
        "weary",
        "worried",
        "wretched",
        "yelling",
        "zombie",
        "abusive",
        "aggressive",
        "apathetic",
        "awkward",
        "bad",
        "bankrupt",
        "broke",
        "chaotic",
        "clumsy",
        "contemptuous",
        "cruel",
        "disgusted",
        "disliked",
        "disrespectful",
        "distrusting",
        "empty",
        "enraged",
        "failing",
        "false",
        "fake",
        "feeble",
        "frustrating",
        "grief-stricken",
        "helpless",
        "hostile",
        "hurting",
        "ill",
        "insufferable",
        "irate",
        "lacking",
        "lousy",
        "mean-spirited",
        "miserable",
        "offended",
        "outdated",
        "overbearing",
        "overconfident",
        "pathetic",
        "poorly",
        "regretful",
        "resentful",
        "sad",
        "shameful",
        "sickening",
        "silent",
        "skeptical",
        "slow",
        "unacceptable",
        "unappreciated",
        "unbelievable",
        "unreliable",
        "untidy",
        "untrustworthy",
        "useless",
        "vile",
        "weak",
        "worthless",
        "yuck",
        "abandoned",
        "apathetic",
        "crushed",
        "disaster",
        "disgusting",
        "exhausted",
        "helpless",
        "inadequate",
        "indecisive",
        "indifferent",
        "ineffective",
        "insincere",
        "irresponsible",
        "nonchalant",
        "obnoxious",
        "resentment",
        "shattered",
        "sickly",
        "toxic",
        "unbearable",
        "unimpressed",
        "uninspired",
        "unprofessional",
        "unsure",
        "unsuccessful",
        "worn-out",
        "wrong",
        "apathetic",
        "horrible",
        "hopeless",
        "impolite",
        "insensitive",
        "lazy",
        "misleading",
        "noisy",
        "offensive",
        "ruthless",
        "selfish",
        "stale",
        "stubborn",
        "unpredictable",
        "untidy",
        "untrustworthy",
        "violent",
        "wrong",
        "wrecked",
        "discontent",
        "desperate",
        "difficult",
        "unresponsive",
        "harassing",
        "obstructive",
        "disconnected",
        "unfriendly",
        "discouraging",
        "irritable",
        "unsympathetic",
        "displeased",
        "unsatisfactory",
        "cranky",
        "disillusioned",
        "unsure",
        "inconsiderate",
        "neglectful",
        "ungrateful",
        "disorganized",
        "insecure",
        "unstable",
        "unrelenting",
        "abysmal",
        "apathetic",
        "baffled",
        "bitterly",
        "bland",
        "burdened",
        "chaotic",
        "clueless",
        "coldhearted",
        "condemnatory",
        "confrontational",
        "corrupt",
        "deceived",
        "defeated",
        "dejected",
        "delusional",
        "dismal",
        "dissatisfied",
        "disheartening",
        "distrustful",
        "downhearted",
        "downturn",
        "dragging",
        "emaciated",
        "embarrassing",
        "empty-hearted",
        "exasperated",
        "exhausted",
        "faulty",
        "fatal",
        "feeble-minded",
        "flawed",
        "forlorn",
        "fraudulent",
        "grumpy",
        "guilty-conscious",
        "heartbroken",
        "hostile",
        "hypocritical",
        "inadequate",
        "indignant",
        "ineffective",
        "insincere",
        "insufferable",
        "intolerable",
        "irrelevant",
        "irrevocable",
        "jeering",
        "joyless",
        "lacking",
        "languid",
        "lazy-minded",
        "lost",
        "malicious",
        "meaningless",
        "misaligned",
        "misbehaving",
        "misguided",
        "mournful",
        "nasty",
        "non-constructive",
        "non-committal",
        "obfuscating",
        "overbearing",
        "overemotional",
        "overwhelmed",
        "pathetic",
        "perplexing",
        "pitiful",
        "resentful",
        "revolting",
        "ruthless",
        "sadistic",
        "sensitive",
        "shaky",
        "sham",
        "shameful",
        "shocking",
        "skeptical",
        "sluggish",
        "snide",
        "sore",
        "suspicious",
        "tedious",
        "tense",
        "threatening",
        "tiring",
        "toxic",
        "unapproachable",
        "unbearable",
        "uncooperative",
        "uncomfortable",
        "uncontrollable",
        "unempathetic",
        "unfriendly",
        "ungracious",
        "unhelpful",
        "uninspiring",
        "unjust",
        "unkind",
        "unmotivated",
        "unproductive",
        "unreliable",
        "unresponsive",
        "unsatisfactory",
        "unsympathetic",
        "untamed",
        "untrustworthy",
        "useless",
        "vague",
        "vexing",
        "violent",
        "volatile",
        "worthless",
        "wretched",
        "zombie-like",
        "burned-out",
        "dismissive",
        "disenfranchised",
        "insensitive",
        "irritating",
        "patronizing",
        "repulsive",
        "resigned",
        "self-centered",
        "shattered",
        "shut-out",
        "submissive",
        "suffering",
        "unruly",
        "upsetting",
        "vulnerable",
        "worn-out",
        "zapped",
        "abhorrent",
        "disillusioned",
        "disenchanting",
        "degrading",
        "detrimental",
        "incoherent",
        "irresponsible",
        "jealous",
        "misleading",
        "unremarkable",
        "unrewarding",
        "unworthy",
        "overworked",
        "prolonged",
        "repressed",
        "unfulfilled",
        "troublesome",
        "unresolved",
        "overwhelming",
        "undesirable",
        "unpredictable",
        "unsolved",
        "unwanted",
        "unsure",
        "abrasive",
        "aggravating",
        "alarming",
        "annoyed",
        "anxious",
        "appalling",
        "atrocious",
        "awkward",
        "baffling",
        "banal",
        "belligerent",
        "bleak",
        "brutal",
        "careless",
        "chaos",
        "clunky",
        "combative",
        "complaining",
        "cranky",
        "creepy",
        "critical",
        "crude",
        "crummy",
        "damaged",
        "dangerous",
        "dark",
        "deafening",
        "defiant",
        "deplorable",
        "deranged",
        "desperate",
        "dirty",
        "disagreeable",
        "disastrous",
        "discontent",
        "discouraged",
        "disgusted",
        "distorted",
        "dizzy",
        "dreadful",
        "dreary",
        "dry",
        "egotistical",
        "embittered",
        "enraged",
        "erratic",
        "evil",
        "excruciating",
        "fake",
        "fearful",
        "fickle",
        "filthy",
        "flimsy",
        "foolish",
        "forgetful",
        "frantic",
        "frozen",
        "glaring",
        "glum",
        "gross",
        "haggard",
        "harsh",
        "haunted",
        "horrendous",
        "idiotic",
        "ignorant",
        "immature",
        "impatient",
        "impolite",
        "impulsive",
        "inattentive",
        "inconvenient",
        "inept",
        "infuriated",
        "inhuman",
        "insane",
        "insidious",
        "insufficient",
        "intimidating",
        "irate",
        "jittery",
        "joyless",
        "jumpy",
        "lousy",
        "manipulative",
        "messy",
        "mindless",
        "moody",
        "mushy",
        "naive",
        "nervous",
        "noisy",
        "obnoxious",
        "offensive",
        "outrageous",
        "overhyped",
        "panicked",
        "paranoid",
        "peculiar",
        "petty",
        "phony",
        "pointless",
        "prickly",
        "problematic",
        "raunchy",
        "reckless",
        "redundant",
        "regretful",
        "rigid",
        "rough",
        "rowdy",
        "rusty",
        "sarcastic",
        "scary",
        "shady",
        "shaky",
        "shattered",
        "shrill",
        "sloppy",
        "smelly",
        "snappy",
        "sneaky",
        "snobbish",
        "spiteful",
        "stale",
        "stiff",
        "stormy",
        "stressful",
        "stuck",
        "stupid",
        "tacky",
        "tedious",
        "terrifying",
        "thoughtless",
        "timid",
        "tough",
        "trivial",
        "uncertain",
        "unclear",
        "uncouth",
        "undermined",
        "uneasy",
        "unethical",
        "unfair",
        "unfocused",
        "unhinged",
        "unimpressed",
        "uninvited",
        "unkempt",
        "unloved",
        "unmotivated",
        "unnerving",
        "unpleasant",
        "unreliable",
        "unsure",
        "untidy",
        "unwelcoming",
        "vicious",
        "vindictive",
        "wary",
        "weak",
        "weird",
        "whiny",
        "wobbly",
        "worried",
        "yucky",
        "zealous",
        "absurd",
        "afraid",
        "agony",
        "allegation",
        "anguish",
        "anomaly",
        "antagonistic",
        "apprehensive",
        "arrogant",
        "ashamed",
        "atrophy",
        "backlash",
        "badger",
        "barbaric",
        "begrudge",
        "belittle",
        "bitter",
        "blame",
        "blunder",
        "boastful",
        "bother",
        "breakdown",
        "buggy",
        "bulky",
        "bully",
        "burden",
        "burnout",
        "catastrophe",
        "chaotic",
        "cheap",
        "clueless",
        "collapse",
        "complaint",
        "condescending",
        "confined",
        "conflict",
        "confused",
        "contaminated",
        "contentious",
        "cranky",
        "crisis",
        "crippled",
        "crooked",
        "cumbersome",
        "damaging",
        "deceit",
        "defaced",
        "defeated",
        "defensive",
        "degraded",
        "dejected",
        "demanding",
        "denied",
        "denounce",
        "dense",
        "desolate",
        "despise",
        "destroyed",
        "detest",
        "detrimental",
        "devastated",
        "difficult",
        "discredited",
        "disgraced",
        "dishonest",
        "disoriented",
        "disrespected",
        "disrupted",
        "distress",
        "disturbed",
        "dodgy",
        "downfall",
        "downtime",
        "dragging",
        "dreaded",
        "drenched",
        "dull",
        "dumped",
        "egocentric",
        "embarrassed",
        "emotionless",
        "erroneous",
        "excluded",
        "exhausted",
        "exploit",
        "failing",
        "faulty",
        "fearsome",
        "feeble",
        "fiasco",
        "fidgety",
        "fool",
        "forgotten",
        "fractured",
        "friction",
        "frightened",
        "frivolous",
        "frustrated",
        "furious",
        "garbage",
        "gloomy",
        "greedy",
        "grim",
        "grossly",
        "grumpy",
        "gullible",
        "hapless",
        "hate",
        "hazard",
        "helpless",
        "hesitant",
        "hostile",
        "humiliated",
        "hurt",
        "hypocrite",
        "ignorance",
        "ignored",
        "illogical",
        "immoral",
        "imperfect",
        "impractical",
        "inaccurate",
        "inadequate",
        "inappropriate",
        "incompetent",
        "indifferent",
        "ineffective",
        "inexcusable",
        "infamous",
        "inferior",
        "infuriating",
        "inhumane",
        "injured",
        "insecure",
        "insensitive",
        "insult",
        "intolerant",
        "irresponsible",
        "isolated",
        "jealous",
        "judgmental",
        "lackluster",
        "lame",
        "lethargic",
        "lifeless",
        "lopsided",
        "lost",
        "malfunction",
        "malicious",
        "mediocre",
        "meltdown",
        "menacing",
        "mess",
        "miserable",
        "misguided",
        "mismanaged",
        "misplaced",
        "misused",
        "nagging",
        "needy",
        "nonsense",
        "notorious",
        "obscene",
        "oppressive",
        "outdated",
        "overbearing",
        "overlooked",
        "overrated",
        "painful",
        "panicky",
        "pathetic",
        "perilous",
        "perplexing",
        "pessimistic",
        "petulant",
        "pitiful",
        "pointless",
        "polluted",
        "poorly",
        "possessive",
        "powerless",
        "precarious",
        "prejudice",
        "pressured",
        "problem",
        "protest",
        "provocative",
        "puzzling",
        "questionable",
        "rage",
        "rebellious",
        "regret",
        "reject",
        "reluctant",
        "remorse",
        "repugnant",
        "resentful",
        "resistance",
        "retaliation",
        "ridiculed",
        "rigorous",
        "rude",
        "ruined",
        "sadness",
        "savage",
        "scam",
        "scarce",
        "screwed",
        "selfish",
        "shallow",
        "shameful",
        "shattered",
        "shortage",
        "shrunk",
        "skeptical",
        "sluggish",
        "smug",
        "snide",
        "sorry",
        "sorrow",
        "spoil",
        "standoffish",
        "stubborn",
        "subpar",
        "superficial",
        "suspect",
        "suspicious",
        "tainted",
        "tense",
        "terrible",
        "tiring",
        "toxic",
        "tragic",
        "troubled",
        "unacceptable",
        "unappealing",
        "unapproved",
        "uncertain",
        "uncomfortable",
        "uncool",
        "undelivered",
        "undesirable",
        "unequal",
        "unfairness",
        "unfit",
        "unforgiving",
        "unfriendly",
        "ungrateful",
        "unhappy",
        "unhelpful",
        "unjust",
        "unkind",
        "unknown",
        "unlucky",
        "unnecessary",
        "unpredictable",
        "unproductive",
        "unprofessional",
        "unreliable",
        "unsatisfied",
        "unsettled",
        "unsuccessful",
        "untested",
        "untrustworthy",
        "unusual",
        "unwanted",
        "upset",
        "useless",
        "vague",
        "vengeful",
        "vexed",
        "villain",
        "vulgar",
        "wasteful",
        "weakness",
        "weep",
        "withdrawn",
        "withered",
        "worthless",
        "wound",
        "wrecked",
        "bad",
        "mad",
        "sad",
        "ugh",
        "ick",
        "lame",
        "poor",
        "hate",
        "pain",
        "fail",
        "junk",
        "yuck",
        "grim",
        "weak",
        "dull",
        "noob",
        "slow",
        "mean",
        "hurt",
        "mess",
        "cold",
        "buggy",
        "lost",
        "sick",
        "bore",
        "blah",
        "lazy",
        "foul",
        "rude",
        "dupe",
        "grim",
        "blip",
        "glum",
        "whack",
        "sour",
        "down",
        "rant",
        "snub",
        "off",
        "drab",
        "icky",
        "skip",
        "worn",
        "blah",
        "void",
        "crap",
        "snag",
        "yell",
        "flop",
        "iffy",
        "meh",
        "nope",
        "oops",
        "ouch",
        "spam",
        "crud",
        "wimp",
        "fuss",
        "gripe",
        "crude",
        "moan",
        "darn",
        "bleh",
        "blah",
        "bump",
        "irk",
        "grit",
        "iffy",
        "whine",
        "vile",
        "spit",
        "fake",
        "wail",
        "blah",
        "snit",
        "blow",
        "pout",
        "rant",
        "grit",
        "dumb",
        "grim",
        "sulk",
        "trap",
        "lose",
        "buzz",
        "trap",
        "iffy"
    ]
};

// Sentiment Analysis Class
class SentimentAnalyzer {
    constructor() {
        this.positiveWords = new Set(sentimentConfig.positiveWords.map(word => word.toLowerCase()));
        this.negativeWords = new Set(sentimentConfig.negativeWords.map(word => word.toLowerCase()));
        this.initializeEventListeners();
        this.initializeCharts();
    }

    initializeEventListeners() {
        // Text analysis button
        document.getElementById('analyzeTextBtn').addEventListener('click', () => {
            const textInput = document.querySelector('.text-input');
            if (textInput && textInput.value.trim()) {
                this.analyzeAndDisplayResults(textInput.value);
            } else {
                alert('Please enter some text to analyze');
            }
        });

        // File analysis button
        document.getElementById('analyzeFileBtn').addEventListener('click', () => {
            const fileInput = document.getElementById('fileInput');
            if (fileInput.files.length > 0) {
                const file = fileInput.files[0];
                const reader = new FileReader();

                reader.onload = (e) => {
                    const text = e.target.result;
                    this.analyzeAndDisplayResults(text);
                };

                reader.onerror = () => {
                    alert('Error reading file. Please try again.');
                };

                reader.readAsText(file);
            } else {
                alert('Please select a file to analyze');
            }
        });

        // File input change handler
        document.getElementById('fileInput').addEventListener('change', (e) => {
            const fileName = e.target.files[0]?.name;
            const selectedFileName = document.getElementById('selectedFileName');
            const fileNameSpan = document.getElementById('fileName');

            if (fileName) {
                selectedFileName.style.display = 'flex';
                fileNameSpan.textContent = fileName;
            } else {
                selectedFileName.style.display = 'none';
            }
        });

        // Dropdown toggle
        const dropdownToggle = document.querySelector('.dropdown-toggle');
        const dropdownMenu = document.querySelector('.dropdown-menu');

        if (dropdownToggle && dropdownMenu) {
            dropdownToggle.addEventListener('click', () => {
                dropdownToggle.classList.toggle('active');
                dropdownMenu.classList.toggle('active');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', (e) => {
                if (!dropdownToggle.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownToggle.classList.remove('active');
                    dropdownMenu.classList.remove('active');
                }
            });
        }

        // Share button dropdown
        const shareBtn = document.querySelector('.share-btn');
        const shareMenu = document.querySelector('.share-menu');

        if (shareBtn && shareMenu) {
            shareBtn.addEventListener('click', () => {
                shareBtn.classList.toggle('active');
                shareMenu.classList.toggle('active');
            });
        }

        // Export button dropdown
        const exportBtn = document.querySelector('.export-btn');
        const exportMenu = document.querySelector('.export-menu');

        if (exportBtn && exportMenu) {
            exportBtn.addEventListener('click', () => {
                exportBtn.classList.toggle('active');
                exportMenu.classList.toggle('active');
            });
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', (e) => {
            if (!shareBtn.contains(e.target) && !shareMenu.contains(e.target)) {
                shareBtn.classList.remove('active');
                shareMenu.classList.remove('active');
            }
            if (!exportBtn.contains(e.target) && !exportMenu.contains(e.target)) {
                exportBtn.classList.remove('active');
                exportMenu.classList.remove('active');
            }
        });
    }

    analyzeAndDisplayResults(text) {
        const results = this.analyzeText(text);
        this.updateUI(results);

        // Show results section
        const resultsSection = document.getElementById('sentimentResults');
        if (resultsSection) {
            resultsSection.style.display = 'block';
            resultsSection.scrollIntoView({ behavior: 'smooth' });
        }

        // Store the analyzed text for file naming
        this.lastAnalyzedText = text;
    }

    analyzeText(text) {
        const words = text.toLowerCase().split(/\s+/);
        let positiveCount = 0;
        let negativeCount = 0;
        let neutralCount = 0;
        let totalWords = words.length;

        // Word frequency analysis
        const wordFrequency = {};
        words.forEach(word => {
            // Remove punctuation and special characters
            word = word.replace(/[.,\/#!$%\^&\*;:{}=\-_`~()]/g, '');
            if (word.length > 0) {
                wordFrequency[word] = (wordFrequency[word] || 0) + 1;
            }
        });

        // Count sentiment words
        words.forEach(word => {
            if (this.positiveWords.has(word)) {
                positiveCount++;
            } else if (this.negativeWords.has(word)) {
                negativeCount++;
            } else {
                neutralCount++;
            }
        });

        // Calculate percentages
        const positivePercentage = Math.round((positiveCount / totalWords) * 100);
        const negativePercentage = Math.round((negativeCount / totalWords) * 100);
        const neutralPercentage = Math.round((neutralCount / totalWords) * 100);

        // Determine overall sentiment
        let overallSentiment = 'neutral';
        if (positivePercentage > negativePercentage && positivePercentage > neutralPercentage) {
            overallSentiment = 'positive';
        } else if (negativePercentage > positivePercentage && negativePercentage > neutralPercentage) {
            overallSentiment = 'negative';
        }

        // Get top 10 most frequent words
        const topWords = Object.entries(wordFrequency)
            .sort((a, b) => b[1] - a[1])
            .slice(0, 10)
            .map(([word, count]) => ({ word, count }));

        return {
            positive: {
                count: positiveCount,
                percentage: positivePercentage
            },
            negative: {
                count: negativeCount,
                percentage: negativePercentage
            },
            neutral: {
                count: neutralCount,
                percentage: neutralPercentage
            },
            totalWords: totalWords,
            overallSentiment: overallSentiment,
            wordFrequency: topWords
        };
    }

    // Update UI with analysis results
    updateUI(results) {
        // Update sentiment cards
        this.updateSentimentCard('positive', results.positive);
        this.updateSentimentCard('negative', results.negative);
        this.updateSentimentCard('neutral', results.neutral);

        // Update statistics summary
        this.updateStatisticsSummary(results);

        // Update charts
        this.updateCharts(results);
    }

    updateSentimentCard(type, data) {
        const card = document.querySelector(`.sentiment-card.${type}`);
        if (card) {
            // Update percentage
            card.querySelector('.stat-value').textContent = `${data.percentage}%`;
            // Update count
            card.querySelector('.stat-item:nth-child(2) .stat-value').textContent = data.count;

            // Update trend indicator
            const trend = card.querySelector('.sentiment-trend');
            if (data.percentage > 50) {
                trend.innerHTML = '<i class="fas fa-arrow-up"></i><span>Increasing</span>';
                trend.className = 'sentiment-trend positive';
            } else if (data.percentage < 30) {
                trend.innerHTML = '<i class="fas fa-arrow-down"></i><span>Decreasing</span>';
                trend.className = 'sentiment-trend negative';
            } else {
                trend.innerHTML = '<i class="fas fa-arrow-right"></i><span>Stable</span>';
                trend.className = 'sentiment-trend neutral';
            }
        }
    }

    updateStatisticsSummary(results) {
        const statCards = document.querySelectorAll('.statistics-summary .stat-card');

        // Update total sentiments
        statCards[0].querySelector('.stat-value').textContent = results.totalWords;

        // Update positive sentiments
        statCards[1].querySelector('.stat-value').textContent = `${results.positive.percentage}%`;

        // Update negative sentiments
        statCards[2].querySelector('.stat-value').textContent = `${results.negative.percentage}%`;

        // Update dominant sentiment
        statCards[3].querySelector('.stat-value').textContent =
            results.overallSentiment.charAt(0).toUpperCase() + results.overallSentiment.slice(1);
        statCards[3].querySelector('.stat-label').textContent =
            `${Math.max(results.positive.percentage, results.negative.percentage, results.neutral.percentage)}%`;
    }

    updateCharts(results) {
        const chartData = {
            labels: ['Positive', 'Neutral', 'Negative'],
            datasets: [{
                data: [
                    results.positive.percentage,
                    results.neutral.percentage,
                    results.negative.percentage
                ],
                backgroundColor: [
                    'rgba(76, 175, 80, 0.8)',    // Positive
                    'rgba(255, 193, 7, 0.8)',    // Neutral
                    'rgba(255, 107, 107, 0.8)'   // Negative
                ]
            }]
        };

        // Update pie chart
        const pieChart = Chart.getChart('pie3DChart');
        if (pieChart) {
            pieChart.data = chartData;
            pieChart.update();
        }

        // Update donut chart
        const donutChart = Chart.getChart('donutChart');
        if (donutChart) {
            donutChart.data = chartData;
            donutChart.update();
        }

        // Update half donut chart
        const halfDonutChart = Chart.getChart('halfDonutChart');
        if (halfDonutChart) {
            halfDonutChart.data = chartData;
            halfDonutChart.update();
        }

        // Update heatmap chart
        const heatmapChart = Chart.getChart('heatmapChart');
        if (heatmapChart) {
            heatmapChart.data.datasets[0].data = [
                results.positive.percentage,
                results.neutral.percentage,
                results.negative.percentage
            ];
            heatmapChart.update();
        }

        // Update radar chart
        const radarChart = Chart.getChart('radarChart');
        if (radarChart) {
            radarChart.data.datasets[0].data = [
                results.positive.percentage,
                results.neutral.percentage,
                results.negative.percentage,
                results.positive.percentage,
                results.neutral.percentage
            ];
            radarChart.data.datasets[1].data = [
                results.neutral.percentage,
                results.positive.percentage,
                results.negative.percentage,
                results.neutral.percentage,
                results.positive.percentage
            ];
            radarChart.data.datasets[2].data = [
                results.negative.percentage,
                results.neutral.percentage,
                results.positive.percentage,
                results.negative.percentage,
                results.neutral.percentage
            ];
            radarChart.update();
        }

        // Update word frequency chart
        const wordFrequencyChart = Chart.getChart('wordFrequencyChart');
        if (wordFrequencyChart) {
            const labels = results.wordFrequency.map(item => item.word);
            const data = results.wordFrequency.map(item => item.count);
            const backgroundColors = results.wordFrequency.map(item => {
                if (this.positiveWords.has(item.word)) {
                    return 'rgba(76, 175, 80, 0.8)';
                } else if (this.negativeWords.has(item.word)) {
                    return 'rgba(255, 107, 107, 0.8)';
                } else {
                    return 'rgba(255, 193, 7, 0.8)';
                }
            });

            wordFrequencyChart.data.labels = labels;
            wordFrequencyChart.data.datasets[0].data = data;
            wordFrequencyChart.data.datasets[0].backgroundColor = backgroundColors;
            wordFrequencyChart.update();
        }
    }

    initializeCharts() {
        const chartConfig = {
            labels: ['Positive', 'Neutral', 'Negative'],
            datasets: [{
                data: [0, 0, 0],
                backgroundColor: [
                    'rgba(76, 175, 80, 0.8)',    // Positive
                    'rgba(255, 193, 7, 0.8)',    // Neutral
                    'rgba(255, 107, 107, 0.8)'   // Negative
                ]
            }]
        };

        // Initialize pie chart
        new Chart(document.getElementById('pie3DChart'), {
            type: 'pie',
            data: chartConfig,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Initialize donut chart
        new Chart(document.getElementById('donutChart'), {
            type: 'doughnut',
            data: chartConfig,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Initialize half donut chart
        new Chart(document.getElementById('halfDonutChart'), {
            type: 'doughnut',
            data: chartConfig,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                circumference: 180,
                rotation: -90,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Initialize heatmap chart
        new Chart(document.getElementById('heatmapChart'), {
            type: 'bar',
            data: {
                labels: chartConfig.labels,
                datasets: [{
                    label: 'Sentiment Intensity',
                    data: [0, 0, 0],
                    backgroundColor: chartConfig.datasets[0].backgroundColor
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });

        // Initialize radar chart
        new Chart(document.getElementById('radarChart'), {
            type: 'radar',
            data: {
                labels: ['Emotional', 'Content', 'Contextual', 'Tone', 'Impact'],
                datasets: [{
                    label: 'Positive',
                    data: [0, 0, 0, 0, 0],
                    backgroundColor: 'rgba(76, 175, 80, 0.2)',
                    borderColor: 'rgba(76, 175, 80, 1)'
                }, {
                    label: 'Neutral',
                    data: [0, 0, 0, 0, 0],
                    backgroundColor: 'rgba(255, 193, 7, 0.2)',
                    borderColor: 'rgba(255, 193, 7, 1)'
                }, {
                    label: 'Negative',
                    data: [0, 0, 0, 0, 0],
                    backgroundColor: 'rgba(255, 107, 107, 0.2)',
                    borderColor: 'rgba(255, 107, 107, 1)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    r: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });

        // Initialize word frequency chart
        new Chart(document.getElementById('wordFrequencyChart'), {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    label: 'Word Frequency',
                    data: [],
                    backgroundColor: []
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    }

    // Add share and download functionality
    shareAnalysis(format) {
        if (!this.lastAnalyzedText) {
            alert('No analysis results to share. Please analyze some text first.');
            return;
        }

        const results = this.analyzeText(this.lastAnalyzedText);
        const filename = this.generateFilename(this.lastAnalyzedText);

        switch (format) {
            case 'csv':
                this.exportToCSV(results, filename);
                break;
            case 'json':
                this.exportToJSON(results, filename);
                break;
        }
    }

    generateFilename(text) {
        // Create a meaningful filename from the text
        const words = text.split(/\s+/).slice(0, 3); // Take first 3 words
        const timestamp = new Date().toISOString().split('T')[0]; // Add date
        return `sentiment_analysis_${words.join('_')}_${timestamp}`;
    }

    exportToCSV(results, filename) {
        let csv = 'Category,Count,Percentage,Trend\n';

        // Add sentiment data
        csv += `Positive,${results.positive.count},${results.positive.percentage}%,Increasing\n`;
        csv += `Neutral,${results.neutral.count},${results.neutral.percentage}%,Stable\n`;
        csv += `Negative,${results.negative.count},${results.negative.percentage}%,Decreasing\n`;

        // Add word frequency data
        csv += '\nWord Frequency Analysis\n';
        csv += 'Word,Count,Sentiment\n';
        results.wordFrequency.forEach(item => {
            const sentiment = this.positiveWords.has(item.word) ? 'Positive' :
                this.negativeWords.has(item.word) ? 'Negative' : 'Neutral';
            csv += `${item.word},${item.count},${sentiment}\n`;
        });

        this.downloadFile(csv, `${filename}.csv`, 'text/csv');
    }

    exportToJSON(results, filename) {
        const jsonData = {
            analysis: {
                positive: {
                    count: results.positive.count,
                    percentage: results.positive.percentage
                },
                neutral: {
                    count: results.neutral.count,
                    percentage: results.neutral.percentage
                },
                negative: {
                    count: results.negative.count,
                    percentage: results.negative.percentage
                },
                totalWords: results.totalWords,
                overallSentiment: results.overallSentiment
            },
            wordFrequency: results.wordFrequency.map(item => ({
                word: item.word,
                count: item.count,
                sentiment: this.positiveWords.has(item.word) ? 'Positive' :
                    this.negativeWords.has(item.word) ? 'Negative' : 'Neutral'
            }))
        };

        const json = JSON.stringify(jsonData, null, 2);
        this.downloadFile(json, `${filename}.json`, 'application/json');
    }

    downloadFile(content, filename, type) {
        const blob = new Blob([content], { type });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.setAttribute('hidden', '');
        a.setAttribute('href', url);
        a.setAttribute('download', filename);
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    }

    shareToClipboard() {
        if (!this.lastAnalyzedText) {
            alert('No analysis results to share. Please analyze some text first.');
            return;
        }

        const results = this.analyzeText(this.lastAnalyzedText);
        const summary = this.formatResultsForSharing(results);

        navigator.clipboard.writeText(summary)
            .then(() => {
                alert('Analysis results copied to clipboard!');
            })
            .catch(err => {
                console.error('Failed to copy text: ', err);
                alert('Failed to copy results to clipboard. Please try again.');
            });
    }

    shareToWhatsApp() {
        if (!this.lastAnalyzedText) {
            alert('No analysis results to share. Please analyze some text first.');
            return;
        }

        const results = this.analyzeText(this.lastAnalyzedText);
        const summary = this.formatResultsForSharing(results);
        const encodedText = encodeURIComponent(summary);
        const whatsappUrl = `https://wa.me/?text=${encodedText}`;

        window.open(whatsappUrl, '_blank');
    }

    shareToEmail() {
        if (!this.lastAnalyzedText) {
            alert('No analysis results to share. Please analyze some text first.');
            return;
        }

        const results = this.analyzeText(this.lastAnalyzedText);
        const summary = this.formatResultsForSharing(results);
        const subject = 'Sentiment Analysis Results';
        const body = encodeURIComponent(summary);

        window.location.href = `mailto:?subject=${encodeURIComponent(subject)}&body=${body}`;
    }

    formatResultsForSharing(results) {
        let summary = '📊 Sentiment Analysis Results\n\n';
        summary += '📈 Overall Analysis:\n';
        summary += `✅ Positive: ${results.positive.percentage}% (${results.positive.count} words)\n`;
        summary += `➖ Neutral: ${results.neutral.percentage}% (${results.neutral.count} words)\n`;
        summary += `❌ Negative: ${results.negative.percentage}% (${results.negative.count} words)\n\n`;

        summary += '📝 Word Frequency Analysis:\n';
        results.wordFrequency.forEach(item => {
            const sentiment = this.positiveWords.has(item.word) ? '✅' :
                this.negativeWords.has(item.word) ? '❌' : '➖';
            summary += `${sentiment} ${item.word}: ${item.count}\n`;
        });

        return summary;
    }
}

// Initialize sentiment analyzer when the page loads
document.addEventListener('DOMContentLoaded', () => {
    window.sentimentAnalyzer = new SentimentAnalyzer();
});

 