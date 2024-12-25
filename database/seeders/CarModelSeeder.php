<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;
use App\Models\CarModel;

class CarModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = Brand::pluck('id', 'name');

        $modelsByBrand = [

            'abarth' => [
                "500", "500c", "595", "595c", "695", "695c", "124_spider", "punto_evo",
                "grande_punto", "500e", "600e", "pulse", "fastback", "autre"
            ],


            'alfa_romeo' => [
                "giulia", "stelvio", "tonale", "33_stradale", "junior", "giulietta", "mito",
                "4c", "8c_competizione", "brera", "gt", "spider", "gta", "alfetta", "alfa_6",
                "alfa_75", "alfa_90", "alfa_33", "alfa_145", "alfa_146", "alfa_147", "alfa_155",
                "alfa_156", "alfa_159", "alfa_164", "alfa_166", "montreal", "sz", "rz", "disco_volante",
                "giulia_quadrifoglio", "stelvio_quadrifoglio", "giulia_gta", "giulia_gtam", "autre"
            ],


            'aston_martin' => [
                "db5", "db6", "db7", "db9", "db11", "db12", "v8_vantage", "v12_vantage", "vanquish",
                "dbs_superleggera", "valkyrie", "valhalla", "dbx", "cygnet", "rapide", "one_77",
                "vulcan", "v12_speedster", "valour", "valiant", "autre"
            ],

            "audi" => [
                "a3", "a4", "q5", "q7", "tt", "a1", "a5", "a6", "a7", "a8", "q2", "q3", "q8",
                "e_tron", "rs3", "rs4", "rs5", "rs6", "rs7", "rs_q8", "s3", "s4", "s5", "s6",
                "s7", "s8", "sq5", "sq7", "sq8", "tt_rs", "tts", "autre"
            ],


            'bentley' => [
                "continental_gt", "continental_gtc", "flying_spur", "bentayga", "mulsanne",
                "arnage", "azure", "brooklands", "turbo_r", "eight", "s1", "s2", "s3", "t_series",
                "r_type", "mark_vi", "mark_v", "blowers", "exp_10_speed_6", "exp_12_speed_6e",
                "exp_100_gt", "autre"
            ],

            'bmw' => [
                "serie_1", "serie_2", "serie_3", "serie_4", "serie_5", "serie_6", "serie_7", "serie_8",
                "x1", "x2", "x3", "x4", "x5", "x6", "x7", "ix1", "ix3", "ix", "z4", "i3", "i4", "i5",
                "i7", "m2", "m3", "m4", "m5", "m8", "x4_m", "x5_m", "x6_m", "xm", "autre"
            ],

            'bugatti' => [
                "type_13", "type_18", "type_23", "type_35", "type_41_royale", "type_57", "type_101",
                "eb110", "veyron", "chiron", "divo", "centodieci", "bolide", "mistral", "tourbillon", "autre"
            ],

            'cadillac' => [
                "ct4", "ct5", "ct6", "escalade", "escalade_esv", "lyriq", "xt4", "xt5", "xt6",
                "celestiq", "escalade_iq", "vistiq", "optiq", "gt4", "ats", "cts", "sts", "dts",
                "eldorado", "seville", "deville", "fleetwood", "brougham", "allante", "srx", "xlr",
                "bls", "autre"
            ],

            'chevrolet' => [
                "aveo", "captiva",  "cruze", "spark", "orlando", "malibu", "camaro", "corvette", "trax",
                "equinox", "trailblazer", "tahoe", "suburban", "silverado", "colorado", "s10", "montana",
                "el_camino", "impala", "bel_air", "chevelle", "nova", "monte_carlo", "blazer", "k5_blazer",
                "ssr", "volt", "bolt_ev", "autre"
            ],

            'chrysler' => [
                "300c", "crossfire",  "grand_voyager", "pt_cruiser", "sebring", "voyager", "aspen",
                "pacifica", "neon", "lebaron", "new_yorker", "imperial", "concorde", "lhs", "cirrus",
                "stratus", "town_and_country", "prowler", "200", "300m", "vision", "windsor", "saratoga",
                "newport", "laser", "daytona", "fifth_avenue", "cordoba", "e_class", "executive", "royal",
                "airflow", "airstream", "imperial_parade_phaeton", "turbine_car", "me_four_twelve",
                "atlantic", "chronos", "firepower", "nassau", "eco_voyager", "200c_ev", "700c_concept",
                "airflite", "autre"

            ],

            'citroën' => [
                "ami", "c1", "c2", "c3", "c3_aircross", "c3_picasso", "c4", "c4_cactus", "c4_picasso",
                "c4_spacetourer", "c4_x", "c5", "c5_aircross", "c5_x", "c6", "c8", "ds3", "ds4", "ds5",
                "e_mehari", "grand_c4_picasso", "grand_c4_spacetourer", "jumper", "jumpy", "saxo",
                "xantia", "xm", "xsara", "xsara_picasso", "zx", "autre"
            ],

            'dacia' => [
                "spring", "sandero", "sandero_stepway", "logan", "duster", "jogger", "dokker", "lodgy",
                "bigster", "autre"
            ],

            'daewoo' => [
                "matiz", "lanos", "nubira", "leganza", "kalos", "lacetti", "evanda", "tacuma", "rezzo",
                "espero", "nexia", "musso", "korando", "rexton", "autre"
            ],

            'daihatsu' => [
                "cuore", "sirion", "terios", "copen", "materia", "charade", "applause", "move", "gran_move",
                "trevis", "yrv", "rocky", "taft", "hijet", "feroza", "delta", "mira", "naked", "opt",
                "pyzar", "storia", "leeza", "midget", "mira_gino", "mira_tocot", "tanto", "wake", "cast",
                "thor", "boon", "ayla", "sigra", "xenia", "luxio", "gran_max", "rocky", "taft", "hijet",
                "mira", "move", "tanto", "cast", "thor", "boon", "ayla", "sigra", "xenia", "luxio",
                "gran_max", "autre"
            ],

            'dodge' => [
                "challenger", "charger", "durango", "ram", "journey", "nitro", "caliber", "avenger",
                "dart", "viper", "magnum", "dakota",  "stealth", "omni", "polara", "monaco", "coronet",
                "lancer", "royal", "wayfarer", "autre"
            ],

            'ferrari' => [
                "sf90_stradale", "roma", "296_gtb", "daytona_sp3", "purosangue", "f80", "monza_sp1",
                "monza_sp2", "laferrari", "enzo_ferrari", "f50", "f40", "288_gto", "testarossa", "512_tr",
                "512_bb", "458_italia", "488_gtb", "f8_tributo", "812_superfast", "812_gts", "portofino",
                "california_t", "gtc4lusso", "ff", "612_scaglietti", "599_gtb_fiorano", "575m_maranello",
                "550_maranello", "456_gt", "365_gtb_4_daytona", "330_p4", "250_gto", "250_testa_rossa",
                "166_mm", "autre"
            ],

            'fiat' => [
                "500", "500e", "500x", "panda", "tipo", "doblo", "ducato", "fiorino", "strada", "toro",
                "mobi", "argo", "cronos", "pulse", "fastback", "600", "topolino", "ulysse", "autre"
            ],

            'ford' => [
                "fiesta", "focus", "kuga", "puma", "mustang", "ranger", "transit_custom", "tourneo_connect",
                "ecosport", "s_max", "galaxy", "mondeo", "edge", "ka_plus", "explorer", "bronco",
                "capri", "mustang_mach_e", "autre"
            ],

            'honda' => [
                "accord", "civic", "cr_v", "pilot", "fit", "odyssey", "hr_v", "passport", "ridgeline",
                "clarity", "insight", "e", "nsx", "civic_type_r", "autre"
            ],

            'hyundai' => [
                "i10", "i20", "i30", "i30_sw", "i30_fastback", "i40", "i40_sw", "ioniq", "ioniq_5",
                "ioniq_6", "ioniq_9", "kona", "kona_electric", "tucson", "santa_fe", "palisade", "bayon",
                "nexo", "staria", "venue", "creta", "alcazar", "casper", "exter", "stargazer", "lafesta",
                "mufasa", "ioniq_5_n", "ioniq_7", "ioniq_9", "n_vision_74", "autre"
            ],

            'infiniti' => [
                "q50", "q60", "q70", "qx30", "qx50", "qx55", "qx60", "qx70", "qx80", "g35", "g37", "m35",
                "m45", "ex35", "fx35", "fx45", "qx4", "autre"
            ],

            'jaguar' => [
                "f_pace", "e_pace", "i_pace", "xe", "xf", "xj", "f_type", "xk", "s_type", "x_type",
                "xjr", "xkr", "xj220", "e_type", "d_type", "c_type", "autre"
            ],

            'jeep' => [
                "wrangler", "grand_cherokee", "cherokee", "compass", "renegade", "gladiator", "wagoneer",
                "grand_wagoneer", "avenger", "commander", "patriot", "liberty", "scrambler", "comanche",
                "autre"
            ],

            'kia' => [
                "picanto", "rio", "ceed", "ceed_sw", "proceed", "stonic", "xceed", "niro", "niro_ev",
                "niro_hybride", "niro_hybride_rechargeable", "seltos", "sportage", "sorento", "sorento_hybride",
                "sorento_hybride_rechargeable", "ev6", "ev9", "carnival", "k5", "k8", "k9", "autre"
            ],

            'lamborghini' => [
                "aventador", "huracan", "urus", "revuelto", "temerario", "miura", "countach", "diablo",
                "murcielago", "gallardo", "sian", "veneno", "reventon", "centenario", "estoque",
                "egoista", "asterion", "terzo_millennio", "lanzador", "autre"
            ],

            'lancia' => [
                "ypsilon", "delta", "gamma", "beta", "fulvia", "stratos", "thema", "kappa", "lybra",
                "thesis", "flavia", "flaminia", "aurelia", "appia", "dedra", "prisma", "montecarlo",
                "scorpion", "037", "s4", "hyena", "voyager", "phedra", "musa", "zeta", "y10", "autre"
            ],

            'land_rover' => [
                "defender", "discovery", "discovery_sport", "range_rover", "range_rover_sport",
                "range_rover_velar", "range_rover_evoque", "autre"
            ],

            'lexus' => [
                "ux", "nx", "rx", "rz", "gx", "lx", "es", "ls", "is", "rc", "lc", "lfa", "lbx", "autre"
            ],

            'lotus' => [
                "elan", "elite", "esprit", "elise", "exige", "evora", "eletre", "emira", "evija", "emeya",
                "autre"
            ],

            'maserati' => [
                "ghibli", "quattroporte", "levante", "granturismo", "grancabrio", "grecale", "mc20",
                "mc20_cielo", "mcx_trema", "gt2_stradale", "autre"
            ],

            'mazda' => [
                "mazda2", "mazda3", "mazda6", "mx_5", "cx_3", "cx_30", "cx_5", "cx_60", "cx_90", "mx_30",
                "autre"
            ],

            'mclaren' => [
                "f1", "p1", "p1_gtr", "12c", "12c_spider", "650s", "650s_spider",  "675lt", "675lt_spider",
                "720s", "720s_spider", "765lt", "765lt_spider", "540c", "570s", "570s_spider", "570gt",
                "600lt", "600lt_spider", "620r", "gt", "artura", "senna", "senna_gtr", "speedtail",
                "elva", "w1", "autre"
            ],

            'mercedes_benz' => [
                "classe_a", "classe_b", "classe_c",  "classe_e", "classe_s", "cla", "cls", "sl", "slc",
                "sls_amg", "amg_gt", "gla", "glb", "glc", "gle", "gls", "classe_g", "eqc", "eqa", "eqb",
                "eqe", "eqs", "vito", "sprinter", "citan", "classe_v", "autre"
            ],

            'mini' => [
                "mini_3_portes", "mini_5_portes", "mini_cabriolet", "mini_clubman", "mini_countryman",
                "mini_john_cooper_works", "mini_electric", "mini_paceman", "mini_coupe", "mini_roadster",
                "autre"
            ],

            'mitsubishi' => [
                "space_star", "colt", "asx", "eclipse_cross", "outlander", "l200", "mirage", "pajero",
                "lancer", "galant", "delica", "xpander", "triton", "montero_sport", "pajero_sport",
                "grandis", "carisma", "chariot", "sigma", "starion", "cordia", "tredia", "magna",
                "diamante", "3000gt", "fto", "i_miev", "lancer_evolution", "autre"
            ],

            'nissan' => [
                "micra", "leaf", "juke", "qashqai", "x_trail", "ariya", "navara", "gt_r", "370z",
                "patrol", "murano", "pathfinder", "note", "pulsar", "almera", "primastar", "townstar",
                "interstar", "nv200", "nv300", "nv400", "autre"
            ],

            'opel' => [
                "corsa", "astra", "insignia", "mokka", "grandland", "crossland", "zafira", "combo_life",
                "vivaro", "movano", "adam", "karl", "antara", "meriva", "tigra", "vectra", "omega",
                "calibra", "monza", "senator", "kadett", "ascona", "manta", "diplomat", "kapitan",
                "admiral", "rekord", "commodore", "speedster", "gt", "frontera", "monterey", "campo",
                "sintra", "agila", "ampera", "ampera_e", "cascada", "autre"
            ],

            'peugeot' => [
                "208", "e_208", "2008", "e_2008", "308", "e_308", "308_sw", "e_308_sw", "408", "508",
                "508_sw", "3008", "e_3008", "5008", "e_5008", "rifter", "e_rifter", "traveller", "e_traveller",
                "partner", "e_partner", "expert", "e_expert", "boxer", "e_boxer", "autre"
            ],

            'porsche' => [
                "911", "911_carrera", "911_targa", "911_turbo", "911_gt3", "911_gt3_rs", "911_dakar",
                "911_s_t", "718_boxster", "718_cayman", "718_spyder", "718_cayman_gt4", "718_cayman_gt4_rs",
                "taycan", "taycan_cross_turismo", "taycan_sport_turismo", "panamera", "panamera_sport_turismo",
                "macan", "cayenne", "cayenne_coupe", "autre"
            ],

            'renault' => [
                "twingo", "clio", "megane", "scenic", "captur", "kadjar", "koleos", "zoe", "arkana",
                "austral", "trafic", "master", "kangoo", "express", "alaskan", "duster", "kwid", "triber",
                "kiger", "taliant",  "rafale", "symbioz", "5_e_tech", "4_e_tech", "scenic_e_tech",
                "megane_e_tech_electric", "autre"
            ],

            'rolls_royce' => [
                "phantom", "ghost", "wraith", "dawn", "cullinan", "spectre", "silver_shadow", "silver_spirit",
                "silver_seraph", "corniche", "camargue", "park_ward", "silver_cloud", "silver_dawn",
                "silver_wraith", "phantom_coupe", "phantom_drophead_coupe", "boat_tail", "autre"
            ],

            'saab' => [
                "saab_92", "saab_93", "saab_94_sonett", "saab_95", "saab_96", "saab_97_sonett_ii",
                "saab_97_sonett_iii", "saab_99", "saab_900", "saab_9000", "saab_9_3", "saab_9_5",
                "saab_9_2x", "saab_9_7x", "saab_9_4x", "autre"
            ],

            'seat' => [
                "ibiza", "leon", "arona", "ateca", "tarraco", "mii", "toledo", "alhambra", "altea",
                "cordoba", "exeo", "marbella", "ronda", "fura", "malaga", "terra", "inca", "arosa", "autre"
            ],

            'skoda' => [
                "fabia", "scala", "kamiq", "octavia", "superb", "karoq", "kodiaq", "enyaq", "elroq", "autre"
            ],

            'smart' => [
                "fortwo", "fortwo_cabrio", "forfour", "roadster", "roadster_coupe", "crossblade",
                "eq_fortwo", "eq_fortwo_cabrio", "eq_forfour", "hashtag_one", "hashtag_two", "hashtag_three",
                "hashtag_four", "hashtag_five", "autre"
            ],

            'subaru' => [
                "impreza", "legacy", "outback", "forester", "crosstrek", "brz", "levorg", "wrx", "ascent",
                "solterra", "tribeca", "baja", "justy", "svx", "trezia", "sambar", "rex", "autre"
            ],

            'suzuki' => [
                "alto_k10", "s_presso", "celerio", "wagon_r", "ignis", "swift", "baleno", "dzire", "ciaz",
                "fronx", "brezza", "grand_vitara", "jimny", "ertiga", "xl6", "invicto", "eeco", "super_carry",
                "autre"
            ],

            'tesla' => [
                "model_s", "model_3", "model_x", "model_y", "cybertruck", "roadster", "semi", "autre"
            ],

            'toyota' => [
                "corolla", "camry", "prius", "yaris", "rav4", "hilux", "land_cruiser", "c_hr",
                "highlander", "supra", "aygo_x", "gr86", "mirai", "proace", "proace_city", "proace_verso",
                "sienna", "tacoma", "tundra", "venza", "sequoia", "4runner", "fortuner", "avanza",
                "innova", "alphard", "vellfire", "sienta", "noah", "voxy", "esquire", "bZ4X", "autre"
            ],

            'volkswagen' => [
                "golf", "polo", "passat", "tiguan", "touareg", "t_roc", "t_cross", "arteon", "touran",
                "sharan", "up", "jetta", "scirocco", "beetle", "eos", "phaeton", "amarok", "caddy",
                "crafter", "multivan", "california", "id_3", "id_4", "id_5", "id_buzz", "id_7", "autre"
            ],

            'volvo' => [
                "s60", "s90", "v60", "v60_cross_country",  "v90", "v90_cross_country", "xc40",  "xc60",
                "xc90", "c40_recharge", "ex30", "ex90", "em90", "autre"
            ],
        ];

        foreach ($modelsByBrand as $brandName => $models) {
            if (isset($brands[$brandName])) {
                foreach ($models as $model) {
                    CarModel::create([
                        'name' => $model,
                        'brand_id' => $brands[$brandName],
                    ]);
                }
            }
        }
    }
}
