<x-mail::message>
# Great news, {{ $name }}!

We are pleased to inform you that your essay, **"{{ $title }}"**, has been selected for publication on the Sri Lankan Literature Hub.

It is now live on our platform and can be shared using the link below:

<x-mail::button :url="config('app.url') . '/essays/' . $slug">
View Your Published Essay
</x-mail::button>

Thank you for your thoughtful contribution to our literary sanctuary. We look forward to seeing more of your work in the future.

Warmly,

The Editorial Team  
[Sri Lankan Lit Hub](https://srilankanlithub.com)
</x-mail::message>
