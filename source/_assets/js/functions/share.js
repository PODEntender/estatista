const fetchUrl = (type, url, title) => {
  switch (type) {
    case 'facebook':
      return 'http://www.facebook.com/share.php?u=:url&t=:title'
        .replace(':url', url)
        .replace(':title', title || '');
    case 'twitter':
      return 'http://twitter.com/intent/tweet?text=:title: :url&via=podentender'
        .replace(':url', url)
        .replace(':title', title || '');
    case 'linkedin':
      return 'http://www.linkedin.com/shareArticle?mini=true&url=:url&title=:title&source=PODEntender'
        .replace(':url', url)
        .replace(':title', title || '');
    case 'reddit':
      return 'https://www.reddit.com/submit?url=:url&title=:title'
        .replace(':url', url)
        .replace(':title', title || '');
  }

  return null;
};

export default function share(type, url, title) {
  const toOpen = fetchUrl(type, url, title);

  if (toOpen) {
    window.open(toOpen, 'share-dialog', 'width=640, height=420');
  }
}
