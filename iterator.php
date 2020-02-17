<?php

class Book
{
    private string $author;
    private string $title;
    private string $year;

    //Имя автора, Название, год издания

    public function __construct(string $title, string $author, string $year)
    {
        $this->author = $author;
        $this->title = $title;
        $this->year = $year;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getYear(): string
    {
        return $this->year;
    }

}

class BookList implements Countable, Iterator
{
    /**
     * @var Book[]
     */
    private array $books = [];
    private int $currentIndex = 0;

    public function addBook(Book $book)
    {
        $this->books[] = $book;
    }

    public function removeBook(Book $bookToRemove)
    {
        foreach ($this->books as $key => $book) {
            if ($book->getTitle() === $bookToRemove->getTitle()) {
                unset($this->books[$key]);
            }
        }

        $this->books = array_values($this->books);
    }

    public function count(): int
    {
        return count($this->books);
    }

    public function current(): Book
    {
        return $this->books[$this->currentIndex];
    }

    public function key(): int
    {
        return $this->currentIndex;
    }

    public function next()
    {
        $this->currentIndex++;
    }

    public function rewind()
    {
        $this->currentIndex = 0;
    }

    public function valid(): bool
    {
        return isset($this->books[$this->currentIndex]);
    }
}


$bookList = new BookList();
$bookList->addBook(new Book('Learning PHP Design Patterns', 'William Sanders', '1975'));
$bookList->addBook(new Book('Professional Php Design Patterns', 'Aaron Saray', '1976'));
$bookList->addBook(new Book('Clean Code', 'Robert C. Martin', '1978'));

$books = [];

foreach ($bookList as $book) {
    $books[] = $book->getTitle();
}

var_dump($books);