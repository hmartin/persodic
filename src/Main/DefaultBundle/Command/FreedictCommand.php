<?php
namespace Main\DefaultBundle\Command;

use Main\DefaultBundle\Entity\Suck;
use Main\DefaultBundle\Entity\Sense;
use Main\DefaultBundle\Entity\Word;
use Main\DefaultBundle\Entity\Ww;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;

class FreedictCommand extends InsertCommand
{
    protected function configure()
    {
        $this
            ->setName('oneShot:freedict');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();

        $xml = simplexml_load_file($this->getContainer()->get('kernel')->getRootDir() . '/../freeDictSource/eng-fra/eng-fra.tei');
        $entries = $xml->text->body->entry;
        $connection = $em->getConnection();
        $statement = $connection->prepare("
         SET FOREIGN_KEY_CHECKS=0;
TRUNCATE `DictionariesWord`;
TRUNCATE `Dictionary`;
TRUNCATE `DictionaryScore`;
TRUNCATE `Point`;
TRUNCATE `Result`;
TRUNCATE `Sense`;
TRUNCATE `Test`;
TRUNCATE `TestWord`;
TRUNCATE `Word`;
TRUNCATE `Ww`;
TRUNCATE `WwSenses`;
         SET FOREIGN_KEY_CHECKS=1;");
        $statement->execute();
        $statement->closeCursor();

        $nbExist = $k = 0;
        $local = 'en';
        $next = true;
        foreach ($entries as $second_gen) {
/*
            if ($next and $second_gen->form->orth != 'patient')
                continue;
            else {
                $next = false;
            }*/
            $word = $this->getWord($second_gen->form->orth, $local);
            $k = $k + 0.1;
            $priority = 0;

            echo '              (origin) ';
            foreach ($second_gen->sense as $senses) {


                $sense = new Sense();
                $sense->setSense('');
                $sense->setLocal('en');

                $em->persist($sense);

                foreach ($senses->cit as $cits) {
                    $tw = $this->getWord($cits->quote, 'fr');
                    //$output->writeln('c:' . $class . '   s:'.$sense.'   w:'. $w  .'   t:' . $tw . ' $prior:' . $prior );
                    $priority = $priority + 1;
                    $prior = $priority + $k;

                    $ww = new Ww();
                    $ww->setWord1($word);
                    $ww->setWord2($tw);
                    $ww->addSense($sense);
                    $ww->setPriority($prior);

                    $em->persist($ww);
                }
            }
        }
        echo $nbExist . ' / ' . $entries->count() . "\n";
        $em->flush();

    }
}