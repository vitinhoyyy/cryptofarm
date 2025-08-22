<?php
// worker.php - Versão adaptada para GitHub Actions
error_reporting(0);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

// Configurações
const host = "https://cryptoads.in/";
const reff = "https://cryptoads.in/?r=944";

// Função para registrar logs
function logMessage($message) {
    $timestamp = date('Y-m-d H:i:s');
    echo "[$timestamp] $message\n";
    // No GitHub Actions, o output aparece diretamente nos logs
}

// Obter configuração de variáveis de ambiente
function getConfig() {
    // Tenta ler de variáveis de ambiente primeiro (GitHub Actions)
    $cookie = getenv('COOKIE');
    $user_agent = getenv('USER_AGENT');
    
    if ($cookie && $user_agent) {
        logMessage("Usando configuração de variáveis de ambiente");
        return [
            'cookie' => $cookie,
            'user-agent' => $user_agent
        ];
    }
    
    // Fallback para arquivo local (para teste local)
    if (file_exists('data.json')) {
        logMessage("Usando arquivo data.json local");
        return json_decode(file_get_contents('data.json'), true);
    }
    
    die("Erro: Nenhuma configuração encontrada. Configure as secrets COOKIE e USER_AGENT no GitHub.");
}

// [MANTENHA TODAS AS SUAS FUNÇÕES ORIGINAIS AQUI]
// function curl(), function iconBypass(), function EmotCaptcha(), etc.
// Cole todas as suas funções originais aqui...

// Função principal do worker
function runWorker() {
    logMessage("Iniciando CryptoAds Worker");
    
    $config = getConfig();
    $cookie = $config['cookie'];
    $user_agent = $config['user-agent'];
    
    $headers = [
        "cookie: $cookie",
        "user-agent: $user_agent",
        "x-requested-with: XMLHttpRequest"
    ];
    
    // [COLE AQUI O RESTO DO SEU CÓDIGO ORIGINAL]
    // Todo o código que estava depois do "banner();" e antes do "while (true)"
    // mas substitua as partes interativas...
    
    // Substitua a parte interativa por seleção automática:
    preg_match_all('#https?:\/\/'.str_replace('.','\.',parse_url(host)['host']).'\/faucet\/currency\/([a-zA-Z0-9]+)#', $dashboard, $matches);
    $temp = [];
    $coins = [];
    foreach ($matches[1] as $item) {
        $lower = strtolower($item);
        if (!in_array($lower, $temp)) {
            $temp[] = $lower;
            $coins[] = $item;
        }
    }
    
    // Seleciona uma moeda aleatória em vez de pedir input
    if (count($coins) > 0) {
        $random_coin = $coins[array_rand($coins)];
        logMessage("Selecionada moeda: " . strtoupper($random_coin));
        $coin = $random_coin;
    } else {
        logMessage("Nenhuma moeda encontrada");
        return;
    }
    
    // [RESTANTE DO SEU CÓDIGO ORIGINAL]
    // Mantenha o loop while(true) mas adicione um limite
    $max_iterations = 5; // Limite para não exceder tempo do GitHub Actions
    $iteration = 0;
    
    while($iteration < $max_iterations) {
        $iteration++;
        // [SEU CÓDIGO DENTRO DO LOOP]
    }
    
    logMessage("Worker finalizado após $iteration iterações");
}

// Executar o worker
runWorker();
?>