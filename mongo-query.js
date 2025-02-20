db.exams.updateOne(
    { _id: ObjectId("67950cd62372e6d8b70b860d") },
    {
        $set: {
            "exam_sections": [
                {
                    "id": "vocabulary",
                    "type": "Vocabulary",
                    "title": "Vocabulary",
                    "available_points": 30,
                    "problems": [
                        {
                            "set": 1,
                            "problem": "<u>の ことばは ひらがなで どう かきますか。1・2・3・4から いちばん いい ものを ひとつ えらんで ください。</u>",
                            "example": {
                                "question": "<u>女の子</u>が うまれました。",
                                "options": [
                                    { "no": 1, "body": "おなのこ", "is_correct": false },
                                    { "no": 2, "body": "おんなのこ", "is_correct": true },
                                    { "no": 3, "body": "おなのこう", "is_correct": false },
                                    { "no": 4, "body": "おんなのこう", "is_correct": false }
                                ]
                            },
                            "questions": [
                                {
                                    "no": 1,
                                    "question": "いま <u>店</u>の まえにいます。",
                                    "options": [
                                        { "no": 1, "body": "いえ", "is_correct": false },
                                        { "no": 2, "body": "えき", "is_correct": false },
                                        { "no": 3, "body": "みせ", "is_correct": true },
                                        { "no": 4, "body": "へや", "is_correct": false }
                                    ]
                                },
                                {
                                    "no": 2,
                                    "question": "たなかさんは いま <u>外国</u>に います。",
                                    "options": [
                                        { "no": 1, "body": "がいしゃ", "is_correct": false },
                                        { "no": 2, "body": "かいしゃ", "is_correct": false },
                                        { "no": 3, "body": "かいこく", "is_correct": false },
                                        { "no": 4, "body": "がいこく", "is_correct": true }
                                    ]
                                },
                                {
                                    "no": 3,
                                    "question": "さとうさんは <u>話</u>が じょうずです。",
                                    "options": [
                                        { "no": 1, "body": "うた", "is_correct": false },
                                        { "no": 2, "body": "はなし", "is_correct": true },
                                        { "no": 3, "body": "え", "is_correct": false },
                                        { "no": 4, "body": "じ", "is_correct": false }
                                    ]
                                },
                                {
                                    "no": 4,
                                    "question": "はやしさんも <u>読</u>んで ください。",
                                    "options": [
                                        { "no": 1, "body": "あそんで", "is_correct": false },
                                        { "no": 2, "body": "ならんで", "is_correct": false },
                                        { "no": 3, "body": "よんで", "is_correct": true },
                                        { "no": 4, "body": "えらんで", "is_correct": false }
                                    ]
                                },
                                {
                                    "no": 5,
                                    "question": "あたらしい こうえんは まちの <u>北</u>がわに あります。",
                                    "options": [
                                        { "no": 1, "body": "ひがしがわ", "is_correct": false },
                                        { "no": 2, "body": "みなみがわ", "is_correct": false },
                                        { "no": 3, "body": "にしがわ", "is_correct": false },
                                        { "no": 4, "body": "きたがわ", "is_correct": true }
                                    ]
                                },
                                {
                                    "no": 6,
                                    "question": "わたしは <u>九月</u>に けっこんします。",
                                    "options": [
                                        { "no": 1, "body": "くがつ", "is_correct": true },
                                        { "no": 2, "body": "きゅうがつ", "is_correct": false },
                                        { "no": 3, "body": "くげつ", "is_correct": false },
                                        { "no": 4, "body": "きゅうげつ", "is_correct": false }
                                    ]
                                },
                                {
                                    "no": 7,
                                    "question": "きのう <u>来</u>なかった ひとは だれですか。",
                                    "options": [
                                        { "no": 1, "body": "きなかった", "is_correct": false },
                                        { "no": 2, "body": "こなかった", "is_correct": true },
                                        { "no": 3, "body": "いなかった", "is_correct": false },
                                        { "no": 4, "body": "ねなかった", "is_correct": false }
                                    ]
                                }
                            ]
                        },
                        {
                            "set": 2,
                            "problem": "<u>の ことばは どう かきますか。1・2・3・4から いちばん いい ものを ひとつ えらんで ください。</u>",
                            "example": {
                                "question": "これは <u>なん</u>の パーティーですか。",
                                "options": [
                                    { "no": 1, "body": "同", "is_correct": false },
                                    { "no": 2, "body": "何", "is_correct": true },
                                    { "no": 3, "body": "向", "is_correct": false },
                                    { "no": 4, "body": "何", "is_correct": false }
                                ]
                            },
                            "questions": [
                                {
                                    "no": 8,
                                    "question": "<u>てんき</u>が わるいですから、うちに いましょう。",
                                    "options": [
                                        { "no": 1, "body": "天汽", "is_correct": false },
                                        { "no": 2, "body": "矢気", "is_correct": false },
                                        { "no": 3, "body": "天気", "is_correct": true },
                                        { "no": 4, "body": "矢汽", "is_correct": false }
                                    ]
                                },
                                {
                                    "no": 9,
                                    "question": "あちらの <u>そら</u>を みてください。",
                                    "options": [
                                        { "no": 1, "body": "犬", "is_correct": false },
                                        { "no": 2, "body": "花", "is_correct": false },
                                        { "no": 3, "body": "山", "is_correct": false },
                                        { "no": 4, "body": "空", "is_correct": true }
                                    ]
                                },
                                {
                                    "no": 10,
                                    "question": "さとうさんも <u>たって</u>ください。",
                                    "options": [
                                        { "no": 1, "body": "立って", "is_correct": true },
                                        { "no": 2, "body": "食って", "is_correct": false },
                                        { "no": 3, "body": "位って", "is_correct": false },
                                        { "no": 4, "body": "喰って", "is_correct": false }
                                    ]
                                },
                                {
                                    "no": 11,
                                    "question": "<u>がくせい</u>は なんにん いますか。",
                                    "options": [
                                        { "no": 1, "body": "先生", "is_correct": false },
                                        { "no": 2, "body": "学生", "is_correct": true },
                                        { "no": 3, "body": "学生", "is_correct": false },
                                        { "no": 4, "body": "先主", "is_correct": false }
                                    ]
                                },
                                {
                                    "no": 12,
                                    "question": "<u>かいだん</u>を おりて ください。",
                                    "options": [
                                        { "no": 1, "body": "上りて", "is_correct": false },
                                        { "no": 2, "body": "止りて", "is_correct": false },
                                        { "no": 3, "body": "不りて", "is_correct": false },
                                        { "no": 4, "body": "下りて", "is_correct": true }
                                    ]
                                }
                            ]
                        },
                        {
                            "set": 3,
                            "problem": "<u>（ ）に なにが はいりますか。1・2・3・4から いちばん いい ものを ひとつ えらんで ください。</u>",
                            "example": {
                                "question": "きのう（ ）へ いきました。",
                                "options": [
                                    { "no": 1, "body": "スプーン", "is_correct": false },
                                    { "no": 2, "body": "ストーブ", "is_correct": false },
                                    { "no": 3, "body": "デパート", "is_correct": true },
                                    { "no": 4, "body": "ニュース", "is_correct": false }
                                ]
                            },
                            "questions": [
                                {
                                    "no": 13,
                                    "question": "えいがの （ ）を ２まい かいました。",
                                    "options": [
                                        { "no": 1, "body": "ケーキ", "is_correct": false },
                                        { "no": 2, "body": "チケット", "is_correct": true },
                                        { "no": 3, "body": "ギター", "is_correct": false },
                                        { "no": 4, "body": "タクシー", "is_correct": false }
                                    ]
                                },
                                {
                                    "no": 14,
                                    "question": "びょういんは うちから （ ）ですから、バスで いきます。",
                                    "options": [
                                        { "no": 1, "body": "ながい", "is_correct": false },
                                        { "no": 2, "body": "おおい", "is_correct": false },
                                        { "no": 3, "body": "おそい", "is_correct": false },
                                        { "no": 4, "body": "とおい", "is_correct": true }
                                    ]
                                },
                                {
                                    "no": 15,
                                    "question": "きょうは いもうとの 12（ ）の たんじょうびです。",
                                    "options": [
                                        { "no": 1, "body": "ねん", "is_correct": false },
                                        { "no": 2, "body": "さい", "is_correct": true },
                                        { "no": 3, "body": "だい", "is_correct": false },
                                        { "no": 4, "body": "えん", "is_correct": false }
                                    ]
                                },
                                {
                                    "no": 16,
                                    "question": "（ ）を わすれましたから、おかねを もって いません。",
                                    "options": [
                                        { "no": 1, "body": "かぎ", "is_correct": false },
                                        { "no": 2, "body": "とけい", "is_correct": false },
                                        { "no": 3, "body": "さいふ", "is_correct": true },
                                        { "no": 4, "body": "かさ", "is_correct": false }
                                    ]
                                },
                                {
                                    "no": 17,
                                    "question": "りょこうの ときは くろい くつを（ ）。",
                                    "options": [
                                        { "no": 1, "body": "はきます", "is_correct": true },
                                        { "no": 2, "body": "つけます", "is_correct": false },
                                        { "no": 3, "body": "かけます", "is_correct": false },
                                        { "no": 4, "body": "かぶります", "is_correct": false }
                                    ]
                                },
                                {
                                    "no": 18,
                                    "question": "きょうは じゅぎょうの あと、すぐ いえに （ ）。",
                                    "options": [
                                        { "no": 1, "body": "かえります", "is_correct": true },
                                        { "no": 2, "body": "すみます", "is_correct": false },
                                        { "no": 3, "body": "あるきます", "is_correct": false },
                                        { "no": 4, "body": "でかけます", "is_correct": false }
                                    ]
                                }
                            ]
                        },
                        {
                            "set": 4,
                            "problem": "<u>の ぷんと だいたい おなじ いみの ぷんが あります。1・2・3・4から いちばん いい ものを ひとつ えらんでください。</u>",
                            "example": {
                                "question": "この <u>コーヒー</u>は まずいです。",
                                "options": [
                                    { "no": 1, "body": "この コーヒーは やすくないです。", "is_correct": false },
                                    { "no": 2, "body": "この コーヒーは おいしくないです。", "is_correct": true },
                                    { "no": 3, "body": "この コーヒーは からくないです。", "is_correct": false },
                                    { "no": 4, "body": "この コーヒーは ふるくないです。", "is_correct": false }
                                ]
                            },
                            "questions": [
                                {
                                    "no": 19,
                                    "question": "<u>けさ</u>、はやしさんに あいました。",
                                    "options": [
                                        { "no": 1, "body": "きのうの あさ、はやしさんに あいました。", "is_correct": false },
                                        { "no": 2, "body": "きょうの ひる、はやしさんに あいました。", "is_correct": false },
                                        { "no": 3, "body": "きょうの あさ、はやしさんに あいました。", "is_correct": true },
                                        { "no": 4, "body": "きのうの ひる、はやしさんに あいました。", "is_correct": false }
                                    ]
                                },
                                {
                                    "no": 20,
                                    "question": "この <u>かんじ</u>は かんたんです。",
                                    "options": [
                                        { "no": 1, "body": "この かんじは やさしいです。", "is_correct": true },
                                        { "no": 2, "body": "この かんじは むずかしいです。", "is_correct": false },
                                        { "no": 3, "body": "この かんじは おもしろいです。", "is_correct": false },
                                        { "no": 4, "body": "この かんじは つまらないです。", "is_correct": false }
                                    ]
                                },
                                {
                                    "no": 21,
                                    "question": "たなかさんは リーミムに <u>さくぶん</u>を おしえました。",
                                    "options": [
                                        { "no": 1, "body": "リーミムは たなかさんに さくぶんを わたしました。", "is_correct": false },
                                        { "no": 2, "body": "たなかさんは リーミムに さくぶんをならいました。", "is_correct": false },
                                        { "no": 3, "body": "たなかさんは リーミムに さくぶんを わたしました。", "is_correct": true },
                                        { "no": 4, "body": "リーミムは たなかさんに さくぶんを ならいました。", "is_correct": false }
                                    ]
                                }
                            ]
                        }
                    ]
                }
            ]
        }
    }
)

db.exams.updateOne(
    { _id: ObjectId("67950cd62372e6d8b70b860d") },
    {
        $push: {
            "exam_sections":
            {
                "id": "grammar",
                "type": "Grammar",
                "title": "Grammar",
                "available_points": 40,
                "problems": [
                    {
                        "set": 1,
                        "problem": "（ ）に なにが はいりますか。1・2・3・4から いちばん いい ものを ひとつ えらんで ください。",
                        "example": {
                            "question": "これ （ ） えんびつです。",
                            "options": [
                                { "no": 1, "body": "に", "is_correct": false },
                                { "no": 2, "body": "を", "is_correct": false },
                                { "no": 3, "body": "は", "is_correct": true },
                                { "no": 4, "body": "や", "is_correct": false }
                            ]
                        },
                        "questions": [
                            {
                                "no": 1,
                                "question": "私は 一か月 （ ） 2回、ギターを 習っています。",
                                "options": [
                                    { "no": 1, "body": "も", "is_correct": false },
                                    { "no": 2, "body": "が", "is_correct": false },
                                    { "no": 3, "body": "を", "is_correct": false },
                                    { "no": 4, "body": "に", "is_correct": true }
                                ]
                            },
                            {
                                "no": 2,
                                "question": "日曜日に 買い物 （ ） さんぽを します。",
                                "options": [
                                    { "no": 1, "body": "へ", "is_correct": false },
                                    { "no": 2, "body": "も", "is_correct": false },
                                    { "no": 3, "body": "や", "is_correct": true },
                                    { "no": 4, "body": "は", "is_correct": false }
                                ]
                            },
                            {
                                "no": 3,
                                "question": "私の 母は 銀行 （ ） はたらいて います。",
                                "options": [
                                    { "no": 1, "body": "が", "is_correct": false },
                                    { "no": 2, "body": "で", "is_correct": true },
                                    { "no": 3, "body": "へ", "is_correct": false },
                                    { "no": 4, "body": "に", "is_correct": false }
                                ]
                            },
                            {
                                "no": 4,
                                "question": "私は 新しい カメラ （ ） ほしいです。",
                                "options": [
                                    { "no": 1, "body": "で", "is_correct": false },
                                    { "no": 2, "body": "か", "is_correct": false },
                                    { "no": 3, "body": "に", "is_correct": false },
                                    { "no": 4, "body": "が", "is_correct": true }
                                ]
                            },
                            {
                                "no": 5,
                                "question": "きのう 私はデパートに 行きましたが、（ ）買いませんでした。",
                                "options": [
                                    { "no": 1, "body": "何を", "is_correct": false },
                                    { "no": 2, "body": "何も", "is_correct": true },
                                    { "no": 3, "body": "何か", "is_correct": false },
                                    { "no": 4, "body": "何に", "is_correct": false }
                                ]
                            },
                            {
                                "no": 6,
                                "question": "A 食堂の ラーメンは、大学の 食堂 のラーメンより （ ）おいしいです。",
                                "options": [
                                    { "no": 1, "body": "あまり", "is_correct": false },
                                    { "no": 2, "body": "すぐ", "is_correct": false },
                                    { "no": 3, "body": "ずっと", "is_correct": true },
                                    { "no": 4, "body": "いちばん", "is_correct": false }
                                ]
                            },
                            {
                                "no": 7,
                                "question": "（店で） A「この ベンは （ ）ですか。」 B「100 円です。」",
                                "options": [
                                    { "no": 1, "body": "いくら", "is_correct": true },
                                    { "no": 2, "body": "いくつ", "is_correct": false },
                                    { "no": 3, "body": "どれ", "is_correct": false },
                                    { "no": 4, "body": "どうして", "is_correct": false }
                                ]
                            },
                            {
                                "no": 8,
                                "question": "きのうの 枝（ ） 前に 本を 読みました。",
                                "options": [
                                    { "no": 1, "body": "ねる", "is_correct": false },
                                    { "no": 2, "body": "ねて", "is_correct": false },
                                    { "no": 3, "body": "ねた", "is_correct": true },
                                    { "no": 4, "body": "ねて いる", "is_correct": false }
                                ]
                            },
                            {
                                "no": 9,
                                "question": "リー「林さん、にもつが 多いですね。少し（ ）。」 林「あ、すみません。おねがいします。」",
                                "options": [
                                    { "no": 1, "body": "持っていませんか", "is_correct": false },
                                    { "no": 2, "body": "持たないで ください", "is_correct": false },
                                    { "no": 3, "body": "持ちましたね", "is_correct": false },
                                    { "no": 4, "body": "持ちましょうか", "is_correct": true }
                                ]
                            }
                        ]
                    },
                    {
                        "set": 2,
                        "problem": "★に入るものはどれですか。1・2・3・4 からいちばん いいもの を一つえらんでください。",
                        "example": {
                            "question": "A「 ＿＿＿＿＿★ ＿＿＿ か。」 B「山田さんです。」",
                            "options": [
                                { "no": 1, "body": "です", "is_correct": false },
                                { "no": 2, "body": "は", "is_correct": false },
                                { "no": 3, "body": "あの人", "is_correct": false },
                                { "no": 4, "body": "だれ", "is_correct": true }
                            ]
                        },
                        "questions": [
                            {
                                "no": 10,
                                "question": "私はたんじょうびに　　　★　　　　　　使っています。",
                                "options": [
                                    { "no": 1, "body": "くれた", "is_correct": false },
                                    { "no": 2, "body": "毎日", "is_correct": false },
                                    { "no": 3, "body": "カメラを", "is_correct": false },
                                    { "no": 4, "body": "そふが", "is_correct": true }
                                ]
                            },
                            {
                                "no": 11,
                                "question": "こうえん　　　　　　　★　　　　たくさん　います。",
                                "options": [
                                    { "no": 1, "body": "鳥", "is_correct": false },
                                    { "no": 2, "body": "に", "is_correct": false },
                                    { "no": 3, "body": "は", "is_correct": false },
                                    { "no": 4, "body": "が", "is_correct": true }
                                ]
                            },
                            {
                                "no": 12,
                                "question": "今年の夏　　　　　　　★　　　　山に　行きます。」",
                                "options": [
                                    { "no": 1, "body": "海", "is_correct": false },
                                    { "no": 2, "body": "では", "is_correct": false },
                                    { "no": 3, "body": "は", "is_correct": false },
                                    { "no": 4, "body": "なくて", "is_correct": true }
                                ]
                            },
                            {
                                "no": 13,
                                "question": "私は 毎朝　へやを　　　　　　　★　　　　出ます。",
                                "options": [
                                    { "no": 1, "body": "を", "is_correct": false },
                                    { "no": 2, "body": "から", "is_correct": false },
                                    { "no": 3, "body": "家", "is_correct": false },
                                    { "no": 4, "body": "そうじして", "is_correct": true }
                                ]
                            }
                        ]
                    },
                    {
                        "set": 3,
                        "problem": "14）から 17）に 何を 入れますか。ぶんしょうの いみを かんがえて、1・2・3・4から いちばん いい ものを 一つ えらんで ください。",
                        "example": null,
                        "questions": [
                            {
                                "no": 14,
                                "question": "（ブラウンさんの さくぶん）先週の日曜日に私ははじめて日本のえいがかんでえいがを見ました。駅の近く（ ）新しいえいがかんで見ました。えいがかんは広くて、とてもきれいでした。また（ ）。",
                                "options": [
                                    { "no": 1, "body": "も", "is_correct": false },
                                    { "no": 2, "body": "は", "is_correct": false },
                                    { "no": 3, "body": "の", "is_correct": true },
                                    { "no": 4, "body": "と", "is_correct": false }
                                ]
                            },
                            {
                                "no": 15,
                                "question": "",
                                "options": [
                                    { "no": 1, "body": "行ってください", "is_correct": false },
                                    { "no": 2, "body": "行きたいです", "is_correct": true },
                                    { "no": 3, "body": "来てください", "is_correct": false },
                                    { "no": 4, "body": "来たいです", "is_correct": false }
                                ]
                            },
                            {
                                "no": 16,
                                "question": "（レーさんの さくぶん）私たちは二つのりょうりを作りました。はじめは、おにぎりを作りました。（ ）、やさいのみそしるを作りました。",
                                "options": [
                                    { "no": 1, "body": "いつも", "is_correct": false },
                                    { "no": 2, "body": "もう", "is_correct": false },
                                    { "no": 3, "body": "しかし", "is_correct": false },
                                    { "no": 4, "body": "それから", "is_correct": true }
                                ]
                            },
                            {
                                "no": 17,
                                "question": "",
                                "options": [
                                    { "no": 1, "body": "かんたんでした", "is_correct": true },
                                    { "no": 2, "body": "かんたんだったからです", "is_correct": false },
                                    { "no": 3, "body": "かんたんではありませんでした", "is_correct": false },
                                    { "no": 4, "body": "かんたんではなかったからです", "is_correct": false }
                                ]
                            }
                        ]
                    },
                    {
                        "set": 4,
                        "problem": "つぎの（1）と（2）のぶんしょうを読んで、しつもんにこたえてください。1・2・3・4からいちばんいいものを一つえらんでください。",
                        "example": null,
                        "questions": [
                            {
                                "no": 18,
                                "question": "（1）（会社で）ムムさんは同じ会社の大友さんにメールをしました。\n\n大友さん\n机の上のおかしをありがとう。旅行はどうでしたか。\n今、大友さんのところに行きましたが、いませんでしたから、メールをしました。\nおいしかったです。ごちそうさまでした。\nムム",
                                "options": [
                                    { "no": 1, "body": "おかしをありがとうございます。", "is_correct": true },
                                    { "no": 2, "body": "わたしも旅行に行きたいです。", "is_correct": false },
                                    { "no": 3, "body": "今、大友さんはどこにいますか。", "is_correct": false },
                                    { "no": 4, "body": "わたしもおかしが好きです。", "is_correct": false }
                                ]
                            },
                            {
                                "no": 19,
                                "question": "（2）学生のころ、私はいつも友だちと話しながら電車で学校に行っていました。今は一人で電車で会社に行きます。会社まで1時間、本を読みながら行きます。今は本が私の友だちです。",
                                "options": [
                                    { "no": 1, "body": "友だちと話します。", "is_correct": false },
                                    { "no": 2, "body": "友だちと本を読みます。", "is_correct": false },
                                    { "no": 3, "body": "一人で本を読みます。", "is_correct": true },
                                    { "no": 4, "body": "会社の人と話します。", "is_correct": false }
                                ]
                            }
                        ]
                    },
                    {
                        "set": 5,
                        "problem": "つぎのぶんしょうを読んで、しつもんにこたえてください。1・2・3・4からいちばんいいものを一つえらんでください。",
                        "example": null,
                        "questions": [
                            {
                                "no": 20,
                                "question": "（青木山のさくぶん）きのう、はじめて青木山にのぼりました。山の上のさくらが見たかったからです。山の入り口から山の上まで2時間かかります。私は15分ぐらいのぼって、すぐにつかれました。でも、山で会った人たちがみんな、私に元気な声で「こんにちは。」と言いました。ちょっと①うれしかったです。1時ごろ山の上に着きました。さくらの木はありましたが、花はありませんでした。近くにいた女の人に「さくらの花はまだですか。」と聞きました。女の人は「山の上は寒いですから、花はまだですよ。来月のはじめごろはきれいですよ。」と言いました。ですから、②来月また行きたいです。",
                                "options": [
                                    { "no": 1, "body": "はじめて青木山にのぼったから", "is_correct": false },
                                    { "no": 2, "body": "山でぜんぜんつかれなかったから", "is_correct": false },
                                    { "no": 3, "body": "山で会った人たちといっしょに山にのぼったから", "is_correct": false },
                                    { "no": 4, "body": "山で会った人たちが「私」に「こんにちは。」と言ったから", "is_correct": true }
                                ]
                            },
                            {
                                "no": 21,
                                "question": "",
                                "options": [
                                    { "no": 1, "body": "さくらの花が見たいから", "is_correct": true },
                                    { "no": 2, "body": "さくらではないほかの花も見たいから", "is_correct": false },
                                    { "no": 3, "body": "山で会った女の人にまた会いたいから", "is_correct": false },
                                    { "no": 4, "body": "山でもっとたくさんの人と話したいから", "is_correct": false }
                                ]
                            }
                        ]
                    },
                    {
                        "set": 6,
                        "problem": "<u>右のページを見て、下のしつもんにこたえてください。1・2・3・4からいちばんいいものを一つえらんでください。</u>",
                        "example": null,
                        "questions": [
                            {
                                "no": 22,
                                "question": "<img src='http://127.0.0.1:8000/images/JLPT200907N501.png' alt='Store Schedule'/><br/>ダトさんは、たまごとりんごを安い日に買いたいです。いつどの店へ行きますか。",
                                "options": [
                                    {
                                        "no": 1,
                                        "body": "13日に④、14日に②",
                                        "is_correct": false
                                    },
                                    {
                                        "no": 2,
                                        "body": "13日に④、15日に①",
                                        "is_correct": true
                                    },
                                    {
                                        "no": 3,
                                        "body": "14日に②、15日に①",
                                        "is_correct": false
                                    },
                                    {
                                        "no": 4,
                                        "body": "14日に②、15日に④",
                                        "is_correct": false
                                    }
                                ]
                            }
                        ]
                    }
                ]
            }
        }
    }
)

db.exams.updateOne(
    { "exam_sections.id": "grammar" },
    {
        $push: {
            "exam_sections.$[elem].problems":
            {
                "set": 6,
                "problem": "<u>右のページを見て、下のしつもんにこたえてください。1・2・3・4からいちばんいいものを一つえらんでください。</u>",
                "example": null,
                "questions": [
                    {
                        "no": 22,
                        "question": "<img src='http://127.0.0.1:8000/images/JLPT200907N501.png' alt='Store Schedule'/><br/>ダトさんは、たまごとりんごを安い日に買いたいです。いつどの店へ行きますか。",
                        "options": [
                            {
                                "no": 1,
                                "body": "13日に④、14日に②",
                                "is_correct": false
                            },
                            {
                                "no": 2,
                                "body": "13日に④、15日に①",
                                "is_correct": true
                            },
                            {
                                "no": 3,
                                "body": "14日に②、15日に①",
                                "is_correct": false
                            },
                            {
                                "no": 4,
                                "body": "14日に②、15日に④",
                                "is_correct": false
                            }
                        ]
                    }
                ]
            }
        }
    },
    {
        arrayFilters: [
            {
                "elem.id": "grammar"
            }
        ]
    }
)

db.exams.updateOne(
    { _id: ObjectId("67950cd62372e6d8b70b860d") },
    {
        $push: {
            "exam_sections":
            {
                "id": "listening",
                "type": "Listening",
                "title": "聴解 (Listening)",
                "minutes": 30,
                "problems": [
                    {
                        "set": 1,
                        "problem": "もんだい1 では、はじめに質問を聞いてください。それから話を聞いて、問題用紙の1から4の中から、一番いいものを一つ選んでください。",
                        "example": {
                            "question": "れい<br><img src='https://kawaii-exam-master.s3.ap-southeast-1.amazonaws.com/JLPT/JLPT202407N502.jpg' alt='Question 1 Image'/>",
                            "options": [
                                { "no": 1, "body": "1", "is_correct": false },
                                { "no": 2, "body": "2", "is_correct": true },
                                { "no": 3, "body": "3", "is_correct": false },
                                { "no": 4, "body": "4", "is_correct": false }
                            ]
                        },
                        "questions": [
                            {
                                "no": 1,
                                "question": "ばん<br><img src='https://kawaii-exam-master.s3.ap-southeast-1.amazonaws.com/JLPT/JLPT202407N503.jpg' alt='Question 1 Image'/>",
                                "options": [
                                    { "no": 1, "body": "1", "is_correct": false },
                                    { "no": 2, "body": "2", "is_correct": true },
                                    { "no": 3, "body": "3", "is_correct": false },
                                    { "no": 4, "body": "4", "is_correct": false }
                                ]
                            },
                            {
                                "no": 2,
                                "question": "ばん",
                                "options": [
                                    { "no": 1, "body": "みどり", "is_correct": true },
                                    { "no": 2, "body": "あお", "is_correct": false },
                                    { "no": 3, "body": "きいろ", "is_correct": false },
                                    { "no": 4, "body": "ちゃいろ", "is_correct": false }
                                ]
                            },
                            {
                                "no": 3,
                                "question": "ばん",
                                "options": [
                                    { "no": 1, "body": "かようび", "is_correct": false },
                                    { "no": 2, "body": "すいようび", "is_correct": true },
                                    { "no": 3, "body": "もくようび", "is_correct": false },
                                    { "no": 4, "body": "きんようび", "is_correct": false }
                                ]
                            },
                            {
                                "no": 4,
                                "question": "ばん",
                                "options": [
                                    { "no": 1, "body": "300えん", "is_correct": false },
                                    { "no": 2, "body": "500えん", "is_correct": true },
                                    { "no": 3, "body": "600えん", "is_correct": false },
                                    { "no": 4, "body": "800えん", "is_correct": false }
                                ]
                            },
                            {
                                "no": 5,
                                "question": "ばん<br><img src='https://kawaii-exam-master.s3.ap-southeast-1.amazonaws.com/JLPT/JLPT202407N504.jpg' alt='Question 5 Image'/>",
                                "options": [
                                    { "no": 1, "body": "1", "is_correct": false },
                                    { "no": 2, "body": "2", "is_correct": false },
                                    { "no": 3, "body": "3", "is_correct": true },
                                    { "no": 4, "body": "4", "is_correct": false }
                                ]
                            },
                            {
                                "no": 6,
                                "question": "ばん",
                                "options": [
                                    { "no": 1, "body": "ノートと ペン", "is_correct": false },
                                    { "no": 2, "body": "ノートと ひるごはん", "is_correct": false },
                                    { "no": 3, "body": "ペンと のみもの", "is_correct": true },
                                    { "no": 4, "body": "のみものと ひるごはん", "is_correct": false }
                                ]
                            },
                            {
                                "no": 7,
                                "question": "ばん<br><img src='https://kawaii-exam-master.s3.ap-southeast-1.amazonaws.com/JLPT/JLPT202407N505.jpg' alt='Question 7 Image'/>",
                                "options": [
                                    { "no": 1, "body": "1", "is_correct": false },
                                    { "no": 2, "body": "2", "is_correct": false },
                                    { "no": 3, "body": "3", "is_correct": false },
                                    { "no": 4, "body": "4", "is_correct": true }
                                ]
                            }
                        ]
                    },
                    // もんだい2 (Problem Set 2: Questions 1–6)
                    {
                        "set": 2,
                        "problem": "もんだい2 では、はじめに質問を聞いてください。それから話を聞いて、問題用紙の1から4の中から、一番いいものを一つ選んでください。",
                        "example": {
                            "question": "れい",
                            "options": [
                                { "no": 1, "body": "としょかん", "is_correct": false },
                                { "no": 2, "body": "えき", "is_correct": false },
                                { "no": 3, "body": "デパート", "is_correct": true },
                                { "no": 4, "body": "レストラン", "is_correct": false }
                            ]
                        },
                        "questions": [
                            {
                                "no": 1,
                                "question": "ばん<br><img src='https://kawaii-exam-master.s3.ap-southeast-1.amazonaws.com/JLPT/JLPT202407N506.jpg' alt='Question 1 Image'/>",
                                "options": [
                                    { "no": 1, "body": "1", "is_correct": true },
                                    { "no": 2, "body": "2", "is_correct": false },
                                    { "no": 3, "body": "3", "is_correct": false },
                                    { "no": 4, "body": "4", "is_correct": false }
                                ]
                            },
                            {
                                "no": 2,
                                "question": "ばん<br><img src='https://kawaii-exam-master.s3.ap-southeast-1.amazonaws.com/JLPT/JLPT202407N507.jpg' alt='Question 3 Image'/>",
                                "options": [
                                    { "no": 1, "body": "1", "is_correct": false },
                                    { "no": 2, "body": "2", "is_correct": false },
                                    { "no": 3, "body": "3", "is_correct": false },
                                    { "no": 4, "body": "4", "is_correct": true }
                                ]
                            },
                            {
                                "no": 3,
                                "question": "ばん<br><img src='https://kawaii-exam-master.s3.ap-southeast-1.amazonaws.com/JLPT/JLPT202407N508.jpg' alt='Question 3 Image'/>",
                                "options": [
                                    { "no": 1, "body": "1", "is_correct": false },
                                    { "no": 2, "body": "2", "is_correct": false },
                                    { "no": 3, "body": "3", "is_correct": false },
                                    { "no": 4, "body": "4", "is_correct": true }
                                ]
                            },
                            {
                                "no": 4,
                                "question": "ばん",
                                "options": [
                                    { "no": 1, "body": "かいしゃのしょくどう", "is_correct": false },
                                    { "no": 2, "body": "ラーメンや", "is_correct": false },
                                    { "no": 3, "body": "うどんや", "is_correct": true },
                                    { "no": 4, "body": "カレーや", "is_correct": false }
                                ]
                            },
                            {
                                "no": 5,
                                "question": "ばん<br><img src='https://kawaii-exam-master.s3.ap-southeast-1.amazonaws.com/JLPT/JLPT202407N509.jpg' alt='Question 5 Image'/>",
                                "options": [
                                    { "no": 1, "body": "1", "is_correct": false },
                                    { "no": 2, "body": "2", "is_correct": true },
                                    { "no": 3, "body": "3", "is_correct": false },
                                    { "no": 4, "body": "4", "is_correct": false }
                                ]
                            },
                            {
                                "no": 6,
                                "question": "ばん",
                                "options": [
                                    { "no": 1, "body": "だい４か", "is_correct": false },
                                    { "no": 2, "body": "だい５か", "is_correct": false },
                                    { "no": 3, "body": "だい６か", "is_correct": false },
                                    { "no": 4, "body": "だい７か", "is_correct": true }
                                ]
                            }
                        ]
                    },
                    {
                        "set": 3,
                        "problem": "もんだい3 では、絵を見ながら質問を聞いてください。矢印の人は何と言いますか。1から3の中から、一番いいものを一つ選んでください。",
                        "example": {
                            "question": "れい<br><img src='https://kawaii-exam-master.s3.ap-southeast-1.amazonaws.com/JLPT/JLPT202407N510.jpg' alt='Example Image'/>",
                            "options": [
                                { "no": 1, "body": "1", "is_correct": false },
                                { "no": 2, "body": "2", "is_correct": true },
                                { "no": 3, "body": "3", "is_correct": false }
                            ]
                        },
                        "questions": [
                            {
                                "no": 1,
                                "question": "ばん<br><img src='https://kawaii-exam-master.s3.ap-southeast-1.amazonaws.com/JLPT/JLPT202407N511.jpg' alt='Question 1 Image'/>",
                                "options": [
                                    { "no": 1, "body": "1", "is_correct": true },
                                    { "no": 2, "body": "2", "is_correct": false },
                                    { "no": 3, "body": "3", "is_correct": false }
                                ]
                            },
                            {
                                "no": 2,
                                "question": "ばん<br><img src='https://kawaii-exam-master.s3.ap-southeast-1.amazonaws.com/JLPT/JLPT202407N512.jpg' alt='Question 2 Image'/>",
                                "options": [
                                    { "no": 1, "body": "1", "is_correct": true },
                                    { "no": 2, "body": "2", "is_correct": false },
                                    { "no": 3, "body": "3", "is_correct": false }
                                ]
                            },
                            {
                                "no": 3,
                                "question": "ばん<br><img src='https://kawaii-exam-master.s3.ap-southeast-1.amazonaws.com/JLPT/JLPT202407N513.jpg' alt='Question 3 Image'/>",
                                "options": [
                                    { "no": 1, "body": "1", "is_correct": false },
                                    { "no": 2, "body": "2", "is_correct": true },
                                    { "no": 3, "body": "3", "is_correct": false }
                                ]
                            },
                            {
                                "no": 4,
                                "question": "ばん<br><img src='https://kawaii-exam-master.s3.ap-southeast-1.amazonaws.com/JLPT/JLPT202407N514.jpg' alt='Question 4 Image'/>",
                                "options": [
                                    { "no": 1, "body": "1", "is_correct": false },
                                    { "no": 2, "body": "2", "is_correct": false },
                                    { "no": 3, "body": "3", "is_correct": true }
                                ]
                            },
                            {
                                "no": 5,
                                "question": "ばん<br><img src='https://kawaii-exam-master.s3.ap-southeast-1.amazonaws.com/JLPT/JLPT202407N515.jpg' alt='Question 5 Image'/>",
                                "options": [
                                    { "no": 1, "body": "1", "is_correct": true },
                                    { "no": 2, "body": "2", "is_correct": false },
                                    { "no": 3, "body": "3", "is_correct": false }
                                ]
                            }
                        ]
                    },
                    {
                        "set": 4,
                        "problem": "もんだい4 もんだい 4 では、えなどが ありません。ぶんを きいて、1 から 3 の なかから、いちばん いい ものを ひとつ えらんで ください。",
                        "example": {
                            "question": "",
                            "options": [
                                { "no": 1, "body": "1", "is_correct": false },
                                { "no": 2, "body": "2", "is_correct": true },
                                { "no": 3, "body": "3", "is_correct": false }
                            ]
                        },
                        "questions": [
                            {
                                "no": 1,
                                "question": "",
                                "options": [
                                    { "no": 1, "body": "1", "is_correct": false },
                                    { "no": 2, "body": "2", "is_correct": true },
                                    { "no": 3, "body": "3", "is_correct": false }
                                ]
                            },
                            {
                                "no": 2,
                                "question": "",
                                "options": [
                                    { "no": 1, "body": "1", "is_correct": false },
                                    { "no": 2, "body": "2", "is_correct": false },
                                    { "no": 3, "body": "3", "is_correct": true }
                                ]
                            },
                            {
                                "no": 3,
                                "question": "",
                                "options": [
                                    { "no": 1, "body": "1", "is_correct": false },
                                    { "no": 2, "body": "2", "is_correct": false },
                                    { "no": 3, "body": "3", "is_correct": true }
                                ]
                            },
                            {
                                "no": 4,
                                "question": "",
                                "options": [
                                    { "no": 1, "body": "1", "is_correct": false },
                                    { "no": 2, "body": "2", "is_correct": true },
                                    { "no": 3, "body": "3", "is_correct": false }
                                ]
                            },
                            {
                                "no": 5,
                                "question": "",
                                "options": [
                                    { "no": 1, "body": "1", "is_correct": true },
                                    { "no": 2, "body": "2", "is_correct": false },
                                    { "no": 3, "body": "3", "is_correct": false }
                                ]
                            },
                            {
                                "no": 6,
                                "question": "",
                                "options": [
                                    { "no": 1, "body": "1", "is_correct": false },
                                    { "no": 2, "body": "2", "is_correct": false },
                                    { "no": 3, "body": "3", "is_correct": true }
                                ]
                            },
                        ]
                    }
                ]
            }
        }
    }
)

db.exams.updateOne(
    { _id: ObjectId("67950cd62372e6d8b70b860d") },
    {
        $set: { "audio_file": "https://kawaii-exam-master.s3.ap-southeast-1.amazonaws.com/JLPT/jlpt_jlpt-n5-2024-07.mp3" }
    }
)

db.exams.updateMany(
    { "exam_sections": { $ne: null } },
    [
        {
            $set: {
                "exam_sections": {
                    $map: {
                        input: "$exam_sections",
                        as: "section",
                        in: {
                            $mergeObjects: [
                                "$$section",
                                { minutes: "$$section.available_points" }
                            ]
                        }
                    }
                }
            },
            $unset: "exam_sections.available_points"
        }
    ]
)


db.results.insert({
    "vocabulary": [],
    "grammer": [],
    "listening": [],
})


db.results.insert(
    {
        "exam_id": "exam_123",
        "user_id": "user_456",
        "results": [
            {
                "id": "vocabulary",
                "title": "Vocabulary",
                "score": 80,
                "answers": [

                ]
            },
            {
                "id": "listening",
                "title": "Listening",
                "score": 90,
                "answers": [

                ]
            }
        ]
    }
)
