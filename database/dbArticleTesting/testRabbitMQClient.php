#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{
  $msg = "test message";
}

$request = array();
$request['type'] = "article";
$request['preference'] = 'general';
$request['message'] = array({
    "status": "ok",
    "totalResults": 38,
    "articles": [
        {
            "source": {
                "id": null,
                "name": "New York Times"
            },
            "author": "Shane Goldmacher, Maggie Haberman",
            "title": "How Trump's Cash Crunch is Affecting the Campaign's Final Weeks - The New York Times",
            "description": "With far less money than anticipated, campaign officials are scrambling to address a severe financial disadvantage against Joseph R. Biden Jr., producing something of an internal blame game.",
            "url": "https:\/\/www.nytimes.com\/2020\/10\/22\/us\/politics\/trump-campaign-money.html",
            "urlToImage": "https:\/\/static01.nyt.com\/images\/2020\/10\/22\/us\/politics\/22trump-money1\/22trump-money1-facebookJumbo.jpg",
            "publishedAt": "2020-10-22T16:07:00Z",
            "content": "Every campaign makes fall ad reservations months in advance and adjusts them as Election Day approaches including the Biden campaign, said Tim Murtaugh, the Trump campaigns communications director, w\u2026 [+2210 chars]"
        },
        {
            "source": {
                "id": null,
                "name": "NBCSports.com"
            },
            "author": "Michael David Smith",
            "title": "Ravens plan to add Dez Bryant to practice squad - NBC Sports - NFL",
            "description": "Yannick Ngakoue is not the only high-profile veteran heading to Baltimore. Dez Bryant is working out and taking a physical with the Ravens, and if all goes well they plan to add him to their practice squad, according to Ian Rapoport of NFL Network. A former C\u2026",
            "url": "https:\/\/profootballtalk.nbcsports.com\/2020\/10\/22\/ravens-plan-to-add-dez-bryant-to-practice-squad\/",
            "urlToImage": "https:\/\/profootballtalk.nbcsports.com\/wp-content\/uploads\/sites\/25\/2020\/10\/GettyImages-502024288-e1603381569558.jpg",
            "publishedAt": "2020-10-22T15:46:00Z",
            "content": "Yannick Ngakoue is not the only high-profile veteran heading to Baltimore.\r\nDez Bryant is working out and taking a physical with the Ravens, and if all goes well they plan to add him to their practic\u2026 [+622 chars]"
        },
        {
            "source": {
                "id": "the-hill",
                "name": "The Hill"
            },
            "author": "Brett Samuels  and Morgan Chalfant",
            "title": "Trump posts full '60 Minutes' interview showing him walking out | TheHill - The Hill",
            "description": "President Trump on\u00a0Thursday posted his full interview with \"60 Minutes\" ahead of...",
            "url": "https:\/\/thehill.com\/homenews\/administration\/522254-trump-posts-full-60-minutes-interview-showing-him-walking-out",
            "urlToImage": "https:\/\/thehill.com\/sites\/default\/files\/trumpdonald_10152020getty.jpg",
            "publishedAt": "2020-10-22T15:38:48Z",
            "content": "President TrumpDonald John TrumpJudge rules to not release Russia probe documents over Trump tweetsTrump and advisers considering firing FBI director after election: WaPoObama to campaign for Biden i\u2026 [+5964 chars]"
        },
        {
            "source": {
                "id": "the-wall-street-journal",
                "name": "The Wall Street Journal"
            },
            "author": "Liz Hoffman",
            "title": "Goldman Sachs to Recoup, Cut Executives\u2019 Pay After Costly 1MDB Fines - The Wall Street Journal",
            "description": "CEO David Solomon, ex-CEO Lloyd Blankfein to be affected by the Wall Street firm\u2019s move",
            "url": "https:\/\/www.wsj.com\/articles\/goldman-sachs-to-recoup-top-executives-pay-after-costly-1mdb-fines-11603380050",
            "urlToImage": "https:\/\/images.wsj.net\/im-248368\/social",
            "publishedAt": "2020-10-22T15:37:00Z",
            "content": "Goldman Sachs\r\n GS 0.87%\r\nGroup Inc. is seizing tens of millions of dollars from top executives after agreeing to a costly settlement to resolve multiple government investigations into its role in a \u2026 [+2481 chars]"
        },
        {
            "source": {
                "id": null,
                "name": "NPR"
            },
            "author": "",
            "title": "Nina Totenberg On Amy Coney Barrett, Anita Hill And Saying Goodbye To RBG - NPR",
            "description": "NPR's legal correspondent has spent decades covering major shifts in the Supreme Court. \"Often, in the beginning, I was the only woman in the newsroom,\" Totenberg says.",
            "url": "https:\/\/www.npr.org\/2020\/10\/26\/926584475\/nina-totenberg-on-amy-coney-barrett-anita-hill-and-saying-goodbye-to-rbg",
            "urlToImage": "https:\/\/media.npr.org\/assets\/img\/2020\/10\/22\/dsc00263_wide-f8a7f9c599fc1d62cecd818cdcdc58b97753bf95.jpg?s=1400",
            "publishedAt": "2020-10-22T15:27:08Z",
            "content": "Nina Totenberg became NPR's legal correspondent in 1975. \"In the beginning, NPR was a tiny little place,\" she says.\r\nWanyu Zhang\/NPR\r\nNPR legal correspondent Nina Totenberg has spent decades covering\u2026 [+6789 chars]"
        },
        {
            "source": {
                "id": null,
                "name": "CBS Sports"
            },
            "author": "",
            "title": "Ravens make trade for Vikings pass rusher Yannick Ngakoue involving swap of draft picks - CBS Sports",
            "description": "Ngakoue was traded to the Vikings during the offseason and now heads to Baltimore",
            "url": "https:\/\/www.cbssports.com\/nfl\/news\/ravens-make-trade-for-vikings-pass-rusher-yannick-ngakoue-involving-swap-of-draft-picks\/",
            "urlToImage": "https:\/\/sportshub.cbsistatic.com\/i\/r\/2020\/10\/22\/70ea9003-afde-4570-887e-b140a4379211\/thumbnail\/1200x675\/eb56338bcec3172e4970c8b771b498a3\/ngakoue-vikings.jpg",
            "publishedAt": "2020-10-22T15:19:00Z",
            "content": "The Baltimore Ravens are adding yet another talented piece to their defense. The Ravens have\u00a0finalized a trade for Minnesota Vikings pass rusher Yannick Ngakoue, per CBS Sports NFL Insider Jason La C\u2026 [+1997 chars]"
        },
        {
            "source": {
                "id": "engadget",
                "name": "Engadget"
            },
            "author": "",
            "title": "Watch OSIRIS-REx take a bite out of asteroid Bennu's surface - Engadget",
            "description": "OSIRIS-REx became the first mission to gather samples from an asteroid after it successfully collected rocky \u201cregolith\u201d material from the surface of Bennu. Now, NASA has released several videos showing exactly how that six-second process looked, and the best \u2026",
            "url": "https:\/\/www.engadget.com\/osirisr-ex-take-a-bite-out-of-asteroid-bennus-surface-141545280.html",
            "urlToImage": "https:\/\/o.aolcdn.com\/images\/dims?resize=1200%2C630&crop=1200%2C630%2C0%2C0&quality=95&image_uri=https%3A%2F%2Fs.yimg.com%2Fos%2Fcreatr-uploaded-images%2F2020-10%2Fe52cb360-1460-11eb-8bd9-c5e82693e5cb&client=amp-blogside-v2&signature=c67ebb2c2e728443aa8b642046c78cde4ef1702e",
            "publishedAt": "2020-10-22T14:45:13Z",
            "content": "The sample collection process was a carefully orchestrated dance. OSIRIS-REx extended its 2 meter (6.6 foot) TAGSAM robotic arm with the 30 cm (1 foot) wide sampling head attached, while folding in i\u2026 [+1346 chars]"
        },
        {
            "source": {
                "id": null,
                "name": "Theguardian.comus-news"
            },
            "author": "Ed Pilkington",
            "title": "CDC rewrites definition for coronavirus 'close contact' - The Guardian",
            "description": "New definition includes people who come into close contact with infected individuals in multiple short bursts over 24-hour period",
            "url": "https:\/\/amp.theguardian.comus-news\/2020\/oct\/22\/cdc-coronavirus-covid-close-contact-definition",
            "urlToImage": "https:\/\/i.guim.co.uk\/img\/media\/2c263835b9d71e1295b54596bf50dcad350b64c4\/0_235_5972_3584\/master\/5972.jpg?width=1200&height=630&quality=85&auto=format&fit=crop&overlay-align=bottom%2Cleft&overlay-width=100p&overlay-base64=L2ltZy9zdGF0aWMvb3ZlcmxheXMvdGctZGVmYXVsdC5wbmc&enable=upscale&s=30d284335ad633441ead601fbb7292dc",
            "publishedAt": "2020-10-22T14:37:00Z",
            "content": "The leading US federal public health agency has rewritten its definition of who is at risk of contracting coronavirus to include people who come into close contact with infected individuals in multip\u2026 [+2032 chars]"
        },
        {
            "source": {
                "id": "fox-news",
                "name": "Fox News"
            },
            "author": "Ryan Gaydos",
            "title": "NFL Week 7 preview: Giants-Eagles lead off while Steelers play Titans in battle of undefeated teams - Fox News",
            "description": "The seventh week of the 2020 NFL season is about to get underway, leading off with a pivotal game between the Philadelphia Eagles and New York Giants.",
            "url": "https:\/\/www.foxnews.com\/sports\/nfl-week-7-preview-2020-season",
            "urlToImage": "https:\/\/static.foxnews.com\/foxnews.com\/content\/uploads\/2020\/10\/Derrick-Henry2.jpg",
            "publishedAt": "2020-10-22T14:36:54Z",
            "content": "The seventh week of the 2020 NFL season is about to get underway, leading off with a pivotal game between the Philadelphia Eagles and New York Giants.\r\nWhile many consider the NFC East to be the wors\u2026 [+9074 chars]"
        },
        {
            "source": {
                "id": "cnn",
                "name": "CNN"
            },
            "author": null,
            "title": "READ: Barack Obama's scathing campaign speech - CNN",
            "description": "Former President Barack Obama delivered a scathing speech on the campaign trail on Wednesday, rebuking President Donald Trump.",
            "url": "https:\/\/www.cnn.com\/2020\/10\/22\/politics\/obama-speech-transcript\/index.html",
            "urlToImage": "https:\/\/cdn.cnn.com\/cnnnext\/dam\/assets\/201022033629-barack-obama-campaigning-for-joe-biden-1021-super-tease.jpg",
            "publishedAt": "2020-10-22T14:33:00Z",
            "content": null
        },
        {
            "source": {
                "id": "cnn",
                "name": "CNN"
            },
            "author": "Marianne Garvey, CNN",
            "title": "Fleetwood Mac's 'Dreams' returns to the charts, thanks to viral TikTok video - CNN",
            "description": "All because of renewed attention from a viral TikTok video, \"Dreams\" has entered the Top 10 on Billboard's streaming songs chart.",
            "url": "https:\/\/www.cnn.com\/2020\/10\/22\/entertainment\/fleetwood-mac-dreams-charts-trnd\/index.html",
            "urlToImage": "https:\/\/cdn.cnn.com\/cnnnext\/dam\/assets\/201022072516-fleetwood-mac-super-tease.jpg",
            "publishedAt": "2020-10-22T14:30:00Z",
            "content": null
        },
        {
            "source": {
                "id": null,
                "name": "Theguardian.comus-news"
            },
            "author": "Chris McGreal",
            "title": "'We need prison time': Purdue's belated guilty plea gets skeptical reaction - The Guardian",
            "description": "While the guilty plea was welcomed, there was also anger over the US justice department\u2019s failure to prosecute executives",
            "url": "https:\/\/amp.theguardian.comus-news\/2020\/oct\/22\/purdue-pharma-opioids-epidemic-guilty-plea-analysis",
            "urlToImage": "https:\/\/i.guim.co.uk\/img\/media\/c42a7e7f369f61ee4d94b791bb965761017ecba0\/0_26_5000_3000\/master\/5000.jpg?width=1200&height=630&quality=85&auto=format&fit=crop&overlay-align=bottom%2Cleft&overlay-width=100p&overlay-base64=L2ltZy9zdGF0aWMvb3ZlcmxheXMvdGctZGVmYXVsdC5wbmc&enable=upscale&s=4cd1490207a541000ff2f4f77a087307",
            "publishedAt": "2020-10-22T14:25:00Z",
            "content": "Lawyers and public relations firms for the Sackler family who own Purdue Pharma have spent months pushing an aggressive campaign to deny that the companys powerful painkiller, OxyContin, unleashed th\u2026 [+6502 chars]"
        },
        {
            "source": {
                "id": null,
                "name": "NPR"
            },
            "author": "",
            "title": "Rudy Giuliani Scene In 'Borat' Sequel Seizes Political Attention - NPR",
            "description": "Borat Subsequent Moviefilm, starring Sacha Baron Cohen, has become a political football during this presidential election season. A scene involving Rudy Giuliani seized social media attention.",
            "url": "https:\/\/www.npr.org\/2020\/10\/22\/926593980\/borat-sequel-grabs-a-political-news-cycle-at-least-momentarily",
            "urlToImage": "https:\/\/media.npr.org\/assets\/img\/2020\/10\/22\/gettyimages-1078129184_wide-3cd4f2a160eca6d1669bd28999df380d8bdef64d.jpg?s=1400",
            "publishedAt": "2020-10-22T14:23:00Z",
            "content": "Borat Subsequent Moviefilm, starring Sacha Baron Cohen, has become a political football during this presidential election season.\r\nLisa O'Connor\/AFP via Getty Images\r\nA scene from the new movie Borat\u2026 [+2049 chars]"
        },
        {
            "source": {
                "id": "cnn",
                "name": "CNN"
            },
            "author": "Dakin Andone, CNN",
            "title": "Judge drops third-degree murder charge against former officer Derek Chauvin in George Floyd's death - CNN",
            "description": "A Hennepin County judge has dropped a third-degree murder charge against former Minneapolis police officer Derek Chauvin in the killing of George Floyd.",
            "url": "https:\/\/www.cnn.com\/2020\/10\/22\/us\/derek-chauvin-george-floyd-charge-dropped\/index.html",
            "urlToImage": "https:\/\/cdn.cnn.com\/cnnnext\/dam\/assets\/200531191644-02-derek-chauvin-mugshot-super-tease.jpg",
            "publishedAt": "2020-10-22T14:13:00Z",
            "content": null
        },
        {
            "source": {
                "id": null,
                "name": "CNBC"
            },
            "author": "Jade Scipioni",
            "title": "Common mouthwashes may have the potential to reduce Covid-19 viral load in the mouth - CNBC",
            "description": "While experts say masks are currently the most effective tool in the fight against Covid-19, researchers found that some common, over-the-counter products may be useful in reducing the \"viral load\" of SARS-CoV-2.",
            "url": "https:\/\/www.cnbc.com\/2020\/10\/22\/mouthwashes-may-have-potential-to-reduce-covid-19-viral-load-in-mouth.html",
            "urlToImage": "https:\/\/image.cnbcfm.com\/api\/v1\/image\/106752453-1603203938755-gettyimages-151060120-941_04_1502705.jpeg?v=1603204059",
            "publishedAt": "2020-10-22T13:58:00Z",
            "content": "Some common drugstore items may have the potential to reduce the oral \"viral load\" of SARS-CoV-2, the coronavirus that causes Covid-19, among those suffering from the illness, according to researcher\u2026 [+4149 chars]"
        },
        {
            "source": {
                "id": "cbs-news",
                "name": "CBS News"
            },
            "author": "Caitlin O'Kane",
            "title": "Puppy with green fur born in Italy - CBS News",
            "description": "The farmer who owns the pup appropriately named him Pistachio.",
            "url": "https:\/\/www.cbsnews.com\/news\/puppy-green-fur-italy\/",
            "urlToImage": "https:\/\/cbsnews1.cbsistatic.com\/hub\/i\/r\/2020\/10\/22\/722e90e8-9881-4eb8-b8ac-233b96a713a9\/thumbnail\/1200x630\/4f4fd101b78ba11e1d11ec22c1136729\/download-1.jpg",
            "publishedAt": "2020-10-22T13:48:00Z",
            "content": "An Italian farmer welcomed a litter of five dogs earlier this month \u2013 and one of the pups stood out among the rest. Cristian Mallocci couldn't believe his eyes when one of them was born with green fu\u2026 [+1534 chars]"
        },
        {
            "source": {
                "id": "nbc-news",
                "name": "NBC News"
            },
            "author": "Yuliya Talmazan, Eric Baculinao, Claudio Lavanga",
            "title": "Pope Francis faces divided Catholic Church after backing same-sex civil unions - NBC News",
            "description": "The bombshell endorsement of same-sex civil unions by Pope Francis on Wednesday has reverberated through the Catholic world.",
            "url": "https:\/\/www.nbcnews.com\/news\/world\/pope-francis-faces-divided-reactions-after-backing-same-sex-civil-n1244243",
            "urlToImage": "https:\/\/media2.s-nbcnews.com\/j\/newscms\/2020_43\/3422054\/201022-pope-francis-mc-920_ab153fbdc425027da138f0a84bcddbfb.nbcnews-fp-1200-630.JPG",
            "publishedAt": "2020-10-22T13:25:00Z",
            "content": "Pope Francis' surprise endorsement of same-sex civil unions reverberated through the Roman Catholic world Thursday, with his comments prompting criticism but also support including from the strongman\u2026 [+3317 chars]"
        },
        {
            "source": {
                "id": null,
                "name": "YouTube"
            },
            "author": null,
            "title": "U.S. Initial Jobless Claims Decline to 787K - Bloomberg Markets and Finance",
            "description": "Oct.22 -- U.S. initial jobless claims in regular state programs declined to 787,000 in the week ended Oct. 17, according to Labor Department data released Th...",
            "url": "https:\/\/www.youtube.com\/watch?v=kCIR9WVLRjY",
            "urlToImage": "https:\/\/i.ytimg.com\/vi\/kCIR9WVLRjY\/hqdefault.jpg",
            "publishedAt": "2020-10-22T13:11:30Z",
            "content": null
        },
        {
            "source": {
                "id": "cbs-news",
                "name": "CBS News"
            },
            "author": "CBS News",
            "title": "Quibi is shutting down six months after the $2 billion video service's debut - CBS News",
            "description": "The company bluntly declared that it \"is not succeeding\" after raising almost $2 billion from Hollywood heavyweights.",
            "url": "https:\/\/www.cbsnews.com\/news\/quibi-shutting-down\/",
            "urlToImage": "https:\/\/cbsnews1.cbsistatic.com\/hub\/i\/r\/2020\/10\/22\/b3e9af0a-de32-41e2-a08f-b62f75494599\/thumbnail\/1200x630\/0eef1f30fd4e00eaf966dfe3a2bd4515\/gettyimages-1210613523.jpg",
            "publishedAt": "2020-10-22T13:09:00Z",
            "content": "Quibi said it is shutting down just six months after the early April launch of the short-video app, having struggled to find customers. The service, which had raised $1.75 billion in funding, was run\u2026 [+3270 chars]"
        },
        {
            "source": {
                "id": null,
                "name": "YouTube"
            },
            "author": null,
            "title": "Amazon Echo (4th gen) review: Hold my sphere - CNET",
            "description": "The fourth-generation Amazon Echo sports a spiffy new shape, great sound quality and easy smart home setup for a reasonable price. It\u2019s one of the best smart...",
            "url": "https:\/\/www.youtube.com\/watch?v=1NLSRREdYZc",
            "urlToImage": "https:\/\/i.ytimg.com\/vi\/1NLSRREdYZc\/hqdefault.jpg",
            "publishedAt": "2020-10-22T13:00:00Z",
            "content": null
        }
    ]
}
)
$response = $client->send_request($request);
//$response = $client->publish($request);

echo "client received response: ".PHP_EOL;
print_r($response);
echo "\n\n";

echo $argv[0]." END".PHP_EOL;

