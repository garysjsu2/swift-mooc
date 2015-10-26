import feedparser

d = feedparser.parse("https://www.edx.org/api/v2/report/course-feed/rss")

print d.entries[0]
