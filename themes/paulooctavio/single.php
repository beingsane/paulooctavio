<?php
/**
 * estou utilizando o get do arquivo .htaccess que pego a url amigavel, se $url for igual $url recebe um novo parametro senão recebe pagina index
 * estou separando a url com / exemplo: site.com.br/single/aquipegoaurl
 * $url[1] = single / $url[2]=aquipegoaurl
 */
//verificando a url e esta voltando url[0] = single, url[1] = exemplo-do-post
$url = strip_tags(trim(filter_input(INPUT_GET, 'url', FILTER_DEFAULT)));
$url = ($url ? $url : 'index');
$url = explode('/', $url);
$url = $url[1];

$imovelController = new ImovelController();
$imagemController = new ImagemController();
$helper = new Helper();

$retornaImovel = $imovelController->retornaImovelUrl($url);

if($retornaImovel == null):
    header("location: ".HOME."/index");
else:
    $cod = $retornaImovel->getCod();
    $titulo = $retornaImovel->getTitulo();
    $area = $retornaImovel->getArea();
    $dormitorio = $retornaImovel->getQuartos();
    $banheiro = $retornaImovel->getBanheiro();
    $suiter = $retornaImovel->getSuite();
    $andar = $retornaImovel->getAndar();
    $vagas = $retornaImovel->getGaragem();
    $descricao = $retornaImovel->getDescricao();
    $aluguel = $retornaImovel->getValor();
    $condominio = $retornaImovel->getCondominio();

?>
<!----------------------------------SLIDE HOME ----------------------------------->
<header class="slide container" id="gallery">
    <div class="wrapper">               
        <div class="jcarousel-wrapper">
            <div class="jcarousel">
                <ul>
                    <?php
                        $listaImagens = $imagemController->CarregarImagensPost($cod);
                        foreach ($listaImagens as $img):                            
                    ?>
                    <li><img src="<?= HOME; ?>/upload/galeria/<?= $img->getImagem(); ?>" alt="Image 1"></li>
                    <?php
                        endforeach;
                    ?>
                </ul>
            </div>
            <a href="#" class="jcarousel-control-prev">&lsaquo;</a>
            <a href="#" class="jcarousel-control-next">&rsaquo;</a>            
        </div>
    </div>
</header>

<header id="mapa" class="container mapa">
    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7678.5634954967245!2d-47.883604!3d-15.789091!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xa4c7c50f0a1708f1!2sPaulOOctavio+Aluguel!5e0!3m2!1spt-BR!2sbr!4v1528296819627" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
</header>

<header id="streetview" class="container streetview">
    <iframe src="https://www.google.com/maps/embed?pb=!4v1528296857853!6m8!1m7!1s48BRbLgcYI8pkmHKQNAs6Q!2m2!1d-15.78904045938639!2d-47.88370097356238!3f101.06256!4f0!5f0.7820865974627469" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
</header>

<!------------------------------- CONTENT SITE -------------------------------->
<main class="main container">
    <div class="content">
        <section class="secao_desc">
            <h1 class="font-zero">Descrição do Imóvel</h1>
            <article class="art_desc">
                <ul class="menu_desc">
                    <li>ASA NORTE</li>
                    <li><span class="fa fa-chevron-right"></span></li>
                    <li><?= $titulo;?></li>
                </ul>

                <!---------------------------------MENU IMOVEL----------------------------------------->
                <div class="btn_nav">
                    <a href="#" id="btn_gallery" class="active btn btn_menu"> <span class="file fa fa-file-image"></span> FOTOS</a>
                    <a href="#" id="btn_mapa" class="btn btn_menu"> <span class="map fa fa-map-signs"></span> MAPA</a>
                    <a href="#" id="btn_360" class="btn btn_menu"> <span class="street fa fa-street-view"></span> 360</a>
                    <a href="#" id="btn_street" class="btn btn_menu"> <span class="view fa fa-share-square"></span> RUA</a>
                </div>

                <!---------------------------------ICONES IMOVEL----------------------------------------->
                <div class="main_icon">
                    <div class="box_icon column column-12">
                        <div class="desc_icons column column-1">
                            <span class="fa fa-minus-square"></span>
                            <p><?= $area;?> m²</p>
                        </div>
                        <div class="desc_icons column column-1">
                            <span class="fa fa-bed"></span>
                            <p><?= $dormitorio;?> DORM</p>
                        </div>
                        <div class="desc_icons column column-2">
                            <span class="fa fa-shower"></span>
                            <p><?= $banheiro;?> BANHEIRO</p>
                        </div>
                        <div class="desc_icons column column-1">
                            <span class="fa fa-shower"></span>
                            <p><?= $suiter;?> SWIT</p>
                        </div>
                        <div class="desc_icons column column-1">
                            <span class="fa fa-car"></span>
                            <p><?= $vagas;?> VAGA</p>
                        </div>
<!--                        <div class="desc_icons column column-1">
                            <span class="fa fa-motorcycle"></span>
                            <p>1 VAGA</p>
                        </div>-->
                        <div class="desc_icons column column-1">
                            <span class="fa fa-building"></span>
                            <p><?= $andar;?> ANDAR</p>
                        </div>                               
                        <div class="desc_icons column column-1">
                            <span class="fa fa-paw"></span>
                            <p>ACEITA PET</p>
                        </div>
                        <div class="desc_icons column column-1">
                            <span class="fa fa-subway"></span>
                            <p>PARADAS PROX.</p>
                        </div>
                    </div>
                </div>                        

                <!------------------------------------ DESCRICAO DO IMOVEL ------------------------------->
                <article class="descricao_imv">
                    <div class="box_descricao_imv">
                        <h1>Descrição do Imóvel</h1>
                        <p>
                            <?php
                            echo html_entity_decode($descricao);
                            ?>
                        </p>
                    </div>
                    <div class="box_descricao_cdm">
                        <h1>Condomínio</h1>
                        <p>
                            Disponível piscina, churrasqueira, academia,
                            salão de festas, sauna, lavanderia no prédio,
                            espaço gourmet na área comum, portaria 24hrs.
                        </p>
                    </div>

                    <div class="box_descricao_cdm">
                        <h1>O quê preciso para alugar este imóvel?</h1>
                        <p>
                            Comprovante de renda mensal bruta de aproximadamente R$ 15.400, 00.
                            A renda pode ser composta por até 4 pessoas físicas. Esse valor
                            pode variar em função do aluguél final acordado.
                        </p>
                    </div>
                </article>
            </article>
        </section>
        <div class="borda-right">.</div>

        <!---------------------------SIDEBAR DESCRICAO ------------------->
        <section class="sidebar_desc">
            <h1 class="font-zero">Informações Gerais</h1>
            <table class="table_desc">                         
                <tr class="tr_color">
                    <td class="info">Aluguel</td>
                    <td class="value">R$ <?= number_format($aluguel, 2, ",", ".")?></td>                            
                </tr>                        
                <tr>
                    <td class="info">Condomínio</td>
                    <td class="value">R$ <?= number_format($condominio, 2, ",", ".")?></td>                            
                </tr>                        
                <tr class="tr_color">
                    <td class="info">IPTU</td>
                    <td class="value">R$ 1.000,00</td>                            
                </tr>                        
                <tr>
                    <td class="info">Seguro Incédio</td>
                    <td class="value">R$ 900,00</td>                            
                </tr>                        
            </table>

            <!--------------------------------------CONTATO DO AGENTE ------------------------>          
            <article class="main_agente">
                <div class="box_agente">
                    <h1>Contatos do(a) Agente</h1>
                    <p>
                        <strong> Nome:</strong> Iolanda<br>
                        <strong>Agente das regiões de: </strong> Asa Norte e demais regiões<br>
                        <strong>Telefone:</strong> (61)3315-8553<br>
                        <strong>Email: </strong>iolanda .tenorio@paulooctavio .com .br<br>
                    </p>
                </div>

                <div class="box_speack_user">
                    <h1 class="font-zero">Horario disponivel e enviar documentos</h1>
                    <a href="#" class="btn btn-clock">
                        <span class="fa fa-clock"></span>
                        Horários Disponiveis para visita
                    </a>

                    <a href="#" class="btn btn-send">
                        <span class="fa fa-upload"></span>
                        Enviar Documentos
                    </a>
                </div>

            </article>
        </section>
    </div>
</main>

<?php
endif;//retorno do imovel url
