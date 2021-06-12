<?php

namespace App\Traits;

trait ManagesQuotes
{
    public function getQuote(): string
    {
        $quotes = [
            'There are no shortcuts to any place worth going.',
            'The capacity to learn is a gift; the ability to learn is a skill; the willingness to learn is a choice.” – Brian Herbert, author.',
            'An investment in knowledge pays the best interest. — Benjamin Franklin, writer and polymath.',
            'Cheating starts mostly in here, thinking that it is okay as long as you are good at hiding and telling lies while being confronted about it.',
            'Let us see who will win, good or evil?',
            'You are good, you are enough... just study ahead of time.',
            'Honesty is the first chapter in the book of wisdom. — Thomas Jefferson',
            'Believe in yourself and all that you are. Know that there is something inside you that is greater than any obstacle. — Christian D. Larson',
            'Doubt whom you will, but never doubt yourself. — Christian Nestell Bovee',
            'Trust yourself, you know more than you think you do. — Dr. Benjamin Spock',
            'It is better to deserve honors and not have them than to have them and not deserve them. — Mark Twain',
            'Living a life of integrity is one of the greatest missions we can undertake. — Greg Anderson',
            'From integrity do we derive excellence.',
            'The future depends on the present. Do your best now and reap the harvest of your actions later.',
            'When you feel like cheating, look at yourself in the mirror and ask yourself: "Do I really want to do this?"',
            'From the seeds of honesty grows the tree of life where the fruits of hard labor shall be consumed by the kind.',
            'All you have to do is work smart and hard, and your future will be bright.',
            'Love yourself, love your future. Do not deceive yourself thinking you have progressed through an easy path. It will be hard. Trust the process.',
            'Honor your commitments with integrity. — Les Brown',
            'Real integrity is doing the right thing, knowing that nobody’s going to know whether you did it or not. ― Oprah Winfrey',
            'To be persuasive we must be believable; to be believable we must be credible; credible we must be truthful. — Edward R. Murrow',
            'One of the truest tests of integrity is its blunt refusal to be compromised. — Chinua Achebe',
            'Integrity without knowledge is weak and useless, and knowledge without integrity is dangerous and dreadful. — Samuel Johnson',
            'We are what we repeatedly do. Excellence, then, is not an act, but a habit. — Aristotle',
            'Learning without thought is labor lost; thought without learning is perilous. — Confucius',
            'I was really too honest a man to be a politician and live. — Socrates',
            'Luck is what happens when preparation meets opportunity. — Seneca',
            'The only true wisdom is in knowing you know nothing. — Socrates',
            'To see things in the seed, that is genius. — Lao Tzu',
        ];

        return $quotes[array_rand($quotes)];
    }
}
