// import AppLogoIcon from './app-logo-icon';

export default function AppLogo() {
    return (
        <>
            <div className="bg-sidebar-primary text-sidebar-primary-foreground flex aspect-square size-8 items-center justify-center rounded-md">
                {/*<AppLogoIcon className="size-5 fill-current text-white dark:text-black" />*/}
                <svg viewBox="0 0 81 40" xmlns="http://www.w3.org/2000/svg">
                    <style>
                        {
                            `
                        .pill-green { fill: #90EE90; }
                        .pill-blue { fill: #4682B4; }
                        .shadow { fill: rgba(0, 0, 0, 0.1); }
                        .text { font-size: 16px; font-family: sans-serif; fill: #2F4F4F; }
                        `
                        }
                    </style>
                    <defs>
                        <linearGradient id="green" x1="0%" y1="0%" x2="100%" y2="0%">
                            <stop offset="0%" stopColor="#00C781" />
                            <stop offset="100%" stopColor="#00C781" stopOpacity="0" />
                        </linearGradient>
                        <linearGradient id="blue" x1="0%" y1="0%" x2="100%" y2="0%">
                            <stop offset="0%" stopColor="#00A0FF" />
                            <stop offset="100%" stopColor="#00A0FF" stopOpacity="0" />
                        </linearGradient>
                    <defs>
                        <filter id="drop-shadow">
                            <feGaussianBlur in="SourceAlpha" stdDeviation="3" />
                            <feOffset dx="1" dy="1" result="offsetblur" />
                            <feComponentTransfer>
                                <feFuncA type="linear" slope="0.5" />
                            </feComponentTransfer>
                            <feMerge>
                                <feMergeNode />
                                <feMergeNode in="SourceGraphic" />
                            </feMerge>
                        </filter>
                    </defs>
                    </defs>
                    <g transform="translate(40.5, 20)">

                        <ellipse className="shadow" cx="2" cy="15" rx="22" ry="5" />

                        <ellipse className="pill-green" cx="-15" cy="0" rx="25" ry="15" />
                        <ellipse className="pill-blue" cx="15" cy="0" rx="25" ry="15" />

                        <rect x="-15" y="-15" width="30" height="30" style={{ fill: "none", stroke: "#000000", strokeWidth: 2 }} />
                    </g>

                    <text x="50" y="170" className="text">xPharma</text>
            </svg>
            </div>
            <div className="ml-1 grid flex-1 text-left text-sm">
                <span className="mb-0.5 truncate leading-none font-semibold">xPharma</span>
            </div>
        </>
    );
}
