<?php 
    require_once('timeDeFutebol.php');

    $time = new Time;
    $time->setNome("Corinthians");
    $time->setAnoFundacao("1910");

    $jogador1 = new Jogador();
    $jogador1->setNomeJogador("Cássio");
    $jogador1->setPosicao("Goleiro");
    $jogador1->setDataNasc("1987-06-06");

    $jogador2 = new Jogador();
    $jogador2->setNomeJogador("Fagner");
    $jogador2->setPosicao("Lateral Direito");
    $jogador2->setDataNasc("1989-06-11");

    $time->addJogador($jogador1);
    $time->addJogador($jogador2);

    $time->escrever();
?>